# /resume — Session Resume Command

When the developer types `/resume`, do the following exactly:

## 1. Read all context files in order

Read these files silently before saying anything:
1. `CLAUDE.md` — project brief, tech stack, client, rules
2. `docs/DESIGN_SYSTEM.md` — brand tokens, components, CSS variables
3. `docs/CONTENT.md` — all approved copy
4. `docs/PAGES.md` — section order and layout specs
5. `PROGRESS.md` — what's been done, what's next

## 2. Scan completed section files

Look inside `site/sections/` and note which files exist to confirm actual completion state matches PROGRESS.md.

## 3. Reply with a crisp briefing — nothing else

Use exactly this format:

---
**Session Resume — St Kevin's Hampton Park**

**Last session:** [date from PROGRESS.md]
**Completed so far:** [count] sections across [count] pages

**Done:**
[bullet list of completed sections with ✅]

**Resume here:**
- Page: [page name]
- Section: [number + name]
- Status: [exact status from PROGRESS.md]
- Search for: "[exact search terms]"

**Open decisions:** [any unresolved choices, or "None"]

**Ready.** Paste the component code when you find it and I'll build the section.

---

## Rules for this command

- Do not ask any clarifying questions
- Do not summarise the entire project history
- Do not repeat content from CLAUDE.md back at the developer
- Just brief, confirm ready, and wait for the component code
- If PROGRESS.md is empty or doesn't exist, say: "No previous progress found. Starting fresh — beginning with Homepage Hero." then announce Section 1 using the standard section announcement format from CLAUDE.md
