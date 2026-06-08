# /resume — Session Resume Command

Behaviour depends on how the command is called.

---

## `/resume [page]` — Resume a specific page

Called as: `/resume about`, `/resume learning`, `/resume community`, `/resume index`, etc.

### 1. Read silently (in order)
1. `_dev/docs/progress-[page].md` — this session's page-specific progress (primary source)
2. `CLAUDE.md` — project brief and working rules
3. The relevant page section in `_dev/docs/PAGES.md` for that page only

Do not load the master `PROGRESS.md` or other page progress files.

### 2. Reply with this exact format — nothing else

---
**Resume — [Page Name]**

**Last session:** [date from progress file]
**Completed so far:** [bullet list with ✅]

**Resume here:**
- Section: [number + name]
- Status: [exact status from progress file]
- Search for: "[exact search terms]"

**Open decisions:** [any unresolved choices, or "None"]

**Ready.**

---

### Rules for page resume
- Do not ask clarifying questions
- Do not repeat CLAUDE.md back to the developer
- Do not summarise the entire project history
- If `_dev/docs/progress-[page].md` doesn't exist: say "No progress found for [page]. Starting fresh — announcing Section 1." then announce Section 1 using the standard section announcement format.

---

## `/resume site` — Full site overview

Called as: `/resume site` or `/resume` with no argument.

### 1. Read silently (in order)
1. `_dev/PROGRESS.md` — master progress (primary source)
2. `CLAUDE.md` — project brief

Do not load individual page progress files.

### 2. Reply with this exact format — nothing else

---
**Resume — Full Site**

**Last session:** [date from _dev/PROGRESS.md]

**Page status:**
- index.html: [done / in progress at Section X / not started]
- about.html: [same]
- learning.html: [same]
- community.html: [same]
- enrolments.html: [same]
- contact.html: [same]
- policies.html: [same]

**Active pages:** [which pages are currently being worked on, and next section for each]

**Ready.**

---

### Rules for site resume
- Do not ask clarifying questions
- Keep it concise — one line per page
- If _dev/PROGRESS.md is empty or doesn't exist: say "No progress found. Starting fresh — beginning with Homepage Hero."
