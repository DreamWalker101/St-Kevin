# /end — Session End Command

When the developer types `/end`, do the following exactly:

## 1. Collect session summary

Gather everything that happened this session:
- Which page was worked on
- Which sections were completed (with file paths)
- Which section is currently in progress (if any)
- Any design decisions made that aren't in DESIGN_SYSTEM.md
- Any deviations from PAGES.md or CONTENT.md and why
- Any problems encountered and how they were solved
- The next section to tackle
- Any patterns or preferences the developer revealed

## 2. Update master PROGRESS.md

Open `_dev/PROGRESS.md` and append one brief block at the bottom:

```
## Session [N] — [date]
- **[page filename]:** [what was completed, one line]. Next: [next section name].
```

If multiple pages were touched this session, one bullet per page. Keep the entire block under 4 lines. Do not repeat decisions or lessons here — those go in the page file.

## 3. Write page-specific progress file

Write a full detailed update to `_dev/docs/progress-[slug].md`
(e.g. `_dev/docs/progress-about.md`, `_dev/docs/progress-learning.md`, `_dev/docs/progress-index.md`).
Create the file if it doesn't exist. Append a new session block if it does.

Use exactly this structure:

```
## Session [N] — [date]

### Completed
- ✅ [section name] → [file path]
(list all completed sections)

### In progress
- 🔄 [section name]
(or "Clean stop — nothing in progress")

### Resume here
**Section:** [number + name]
**Search terms:** "[exact terms]"
**Status:** [Not started / Component found / Partially built]

### Decisions
- [decision]: [why]

### Lessons
- [pattern or insight]: [what to do / avoid next time]

### Problems to watch out for
- [gotchas or live issues]

### Files changed
- [file path]: [one-line description]
```

## 4. Commit everything

Run a final commit with message: `chore: session end — progress updated`

## 5. Confirm to the developer

Reply with:
- What was completed this session
- Exactly where to resume
- One-line reminder of the search terms needed for the next section
