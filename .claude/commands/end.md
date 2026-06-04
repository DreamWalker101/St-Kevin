# /end — Session End Command

When the developer types `/end`, do the following exactly:

## 1. Collect session summary

Gather everything that happened this session:
- Which sections were completed (with file paths)
- Which section is currently in progress (if any)
- Any design decisions made that aren't in DESIGN_SYSTEM.md
- Any deviations from PAGES.md or CONTENT.md and why
- Exact search terms that worked well for finding UIverse/CodePen components
- Any problems encountered and how they were solved
- The next section to tackle in the next session
- Any patterns or preferences the developer revealed about how they like things built

## 2. Update PROGRESS.md

Open `PROGRESS.md` and append a new session block with this exact structure:

```
## Session [increment number] — [today's date]

### Completed this session
- ✅ [section name] → [file path]
(list all completed sections)

### In progress
- 🔄 [section name] → [file path if started]
(or "Nothing in progress — clean stop")

### Resume here next session
**Page:** [page name]
**Section:** [section name and number]
**Search terms to find component:** "[exact terms]"
**Status:** [Not started / Component found but not integrated / Partially built]

### Decisions made this session
- [decision]: [why]
(list any choices made about design, layout, content, or code)

### Lessons learned this session
- [pattern or insight]: [what to do differently / keep doing next time]
(examples: "user prefers X over Y", "this approach caused Z bug — use W instead",
"this library conflicted with GSAP — avoid", "client wants images larger than spec says")
These accumulate into institutional knowledge. Future sessions should read these
before starting work so they don't repeat the same mistakes or miss the same preferences.

### Problems to watch out for
- [any gotchas or issues discovered]

### Files changed this session
- [list every file touched with a one-line description]
```

## 3. Commit everything

Run a final commit with message: `chore: session end — progress updated`

## 4. Confirm to the developer

Reply with a short summary:
- What was completed
- Exactly where to resume
- One-line reminder of the search terms needed for the next section
