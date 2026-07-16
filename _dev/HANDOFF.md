# St Kevin's — Deployment & Server Handoff

> Last updated: 2026-07-16. This site now uses the **same clean deploy method as
> the other school sites** (St Patrick's/spmentone, Good Shepherd, St Thomas).
> The old bespoke webhook method (`deploy.php`, `.cpanel.yml`, `deploy-config.php`,
> `st-kevins-plainpress/`) has been **removed** — ignore any older notes referring to it.

---

## 1. How deploys work now

```
edit under site/  →  push to main  →  GitHub Action builds the `deploy` branch
(linear, fast-forwardable)  →  cPanel "Update from Remote"  →  live at
https://dev.on5.io/st-kevins/
```

- **Repo:** https://github.com/DreamWalker101/St-Kevin (must stay **Public** — cPanel
  clones over HTTPS with no credentials).
- **Workflow:** `.github/workflows/deploy.yml` — on every push to `main`, it rsyncs
  `site/` onto the existing `deploy` branch and commits **on top** (no orphan, no
  `--force`). This keeps history linear so cPanel can fast-forward. **Never
  force-push `deploy`** — that reintroduces the "Diverging branches can't be
  fast-forwarded" (error 128) failure this migration fixed.
- **Excluded from deploy:** `*.md`, `.git`, `.github`, `.gitignore`,
  `admin/config.php`, `admin/emails.json`, `admin/otp-debug.log`.

### To ship a change
1. Edit files under `site/`, commit, `git push origin main`.
2. Wait ~1 min for the Action (green check on GitHub).
3. cPanel → **Git™ Version Control → St-Kevin → Manage → Update from Remote**
   (or on the server: `cd ~/public_html/st-kevins && git fetch origin && git merge --ff-only origin/deploy`).

### cPanel Git registry (already configured)
- **Repository root:** `/home/devon5io/public_html/st-kevins`
- **Checked-out branch:** `deploy`
- **Remote:** `origin → https://github.com/DreamWalker101/St-Kevin`
- No `.cpanel.yml` deployment tasks (matches spmentone — plain checkout only).

---

## 2. Outstanding manual server-only steps

These are per-environment and intentionally **not** in git.

### 2a. Admin dashboard — clears the current 500  ← DO THIS FIRST
`https://dev.on5.io/st-kevins/admin/` returns **500** only because
`admin/config.php` is missing on the server. The admin uses **email-OTP login**
(same as the other school sites) and needs **two** per-environment files —
`config.php` and `emails.json`. Both are gitignored and excluded from deploy, so
create them once on the server.

**1) `~/public_html/st-kevins/admin/config.php`**
```php
<?php
define('DEV_MODE', true);                       // staging: OTP is logged, not emailed
define('OTP_FROM_EMAIL', 'noreply@dev.on5.io'); // real domain: use noreply@<real-domain>
define('OTP_FROM_NAME',  "St Kevin's Hampton Park");
```

**2) `~/public_html/st-kevins/admin/emails.json`** — allowed admin login emails (JSON array)
```json
[
  "administration@skhamptonpark.catholic.edu.au"
]
```

**3) Permissions**
```bash
chmod 644 ~/public_html/st-kevins/admin/config.php ~/public_html/st-kevins/admin/emails.json
```

**4) How to log in** — go to `/st-kevins/admin/`, enter an allowed email → a 6-digit
code is issued (expires 10 min; 5 wrong attempts locks it; 60s between requests).
- **Staging (`DEV_MODE = true`):** the code is **not** emailed (dev.on5.io mail is
  unreliable) — read it from the log:
  ```bash
  tail -n 5 ~/public_html/st-kevins/admin/otp-debug.log
  ```
- **Real domain (`DEV_MODE = false`):** the code is emailed — needs working
  SPF/DKIM/DMARC on the sending domain (see §2c / §3).

### 2b. Permissions
Folders `755`, files `644`. (The site folder was normalised from `705 → 755`
during migration; new files from git inherit correctly, but re-check after any
manual upload.)

### 2c. Contact form email
`site/contact.php` sends via PHP `mail()` to a hardcoded
`RECIPIENT_EMAIL = administration@skhamptonpark.catholic.edu.au`
(defined in the file — no config needed). It works on deploy, **but delivery is
the catch:**
- On **dev.on5.io** (staging), mail from this server frequently gets dropped by
  Gmail/Outlook because dev.on5.io has no valid SPF/DKIM/DMARC (DNS is on
  Cloudflare). Expect contact-form and any admin mail to be unreliable here.
- On the **real domain** (see §3), configure SPF/DKIM/DMARC for the sending
  domain (cPanel → Email Deliverability → Repair, or add records at the DNS
  provider). Verify with cPanel → Track Delivery.

---

## 3. Moving to the real domain

Target: `https://www.skhamptonpark.catholic.edu.au/` (currently a WordPress site).
When ready:
1. Add the domain in cPanel (Addon Domain or point an existing docroot), or
   repoint the Git clone. The cleanest path mirroring the other sites:
   - Create the domain's docroot, then **cPanel → Git Version Control → Create**,
     clone `https://github.com/DreamWalker101/St-Kevin.git`, branch `deploy`, into
     that docroot (instead of / in addition to `public_html/st-kevins`).
   - Re-do the manual steps in §2 (config.php, perms) in the new docroot.
2. DNS is on **Cloudflare** — update records there; allow for proxy/caching
   (purge Cloudflare cache after go-live).
3. Fix email deliverability for the real domain (§2c) and set the contact form's
   `RECIPIENT_EMAIL` / any `From` domain to match, so SPF/DKIM/DMARC align.
4. Update the internal absolute links / canonical (`<link rel="canonical">` already
   points at the real domain).

---

## 4. Gotchas (learned the hard way)
- **Public repo required** — private repos fail cPanel HTTPS clone (error 128,
  "could not read Username").
- **Never force-push `deploy`** — breaks cPanel fast-forward. The workflow is
  already correct; don't "simplify" it back to `git init` + `push --force`.
- **755 or bust** — a `700`/`705` site folder can make the web server 403 on `/`
  and 404 on pages. Keep it `755`.
- **Config lives in `admin/`, not site root** — `admin/index.php` loads it via
  `__DIR__`. Wrong location → 500.
- To resync a stuck clone after any history hiccup:
  `cd ~/public_html/st-kevins && git fetch origin && git reset --hard origin/deploy`
  (preserves untracked `config.php`).
