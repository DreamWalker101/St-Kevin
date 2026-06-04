# /restore — Sync From GitHub

Pull the latest pushed changes from GitHub into the current working directory.
Use this at the start of any session on a device that wasn't the last one used.

## Steps

1. Run `git status` to check for any uncommitted local changes
2. If there are uncommitted changes, warn the user and ask whether to stash or commit them first — never auto-discard work
3. If the working tree is clean (or after resolving), run `git pull origin main`
4. Report what changed: files updated, commits pulled, and any conflicts
5. Confirm the working tree is now in sync with GitHub

## Output format

```
✓ Restored from GitHub
  Branch: main
  Commits pulled: X
  Files updated: [list key files changed]
  Resume point: [read last entry in PROGRESS.md and show current section]
```

If there were local uncommitted changes, clearly state what was done with them (stashed / committed / left as-is per user instruction).

## Edge cases

- **No changes to pull** (already up to date): say so clearly — "Already up to date. No changes pulled."
- **Merge conflict**: do not auto-resolve. Show the conflicting files and ask the user how to proceed.
- **Uncommitted local changes**: always warn before pulling. Never silently overwrite.
