# Claude Code Subagent Team — Setup Guide

A 5-agent team tailored to a Laravel 12 / Filament 3 / Livewire 3 / MySQL stack
(Build Syntax projects: e-commerce + Paymob, appointments, POS).

## The team

| Agent | Role | Writes code? |
|---|---|---|
| laravel-architect | Plans features, produces specs | No (read-only) |
| laravel-implementer | Writes the code per spec | Yes |
| test-runner | Runs Pest/PHPUnit + static analysis, summarizes | No |
| code-reviewer | Reviews the diff, blocks on security issues | No (read-only) |
| db-expert | Schemas, migrations, query optimization | Yes (DB files only) |
| deploy-verifier | Post-deploy health checks on the VPS | No |

## Step 1 — Install the agents

**Option A — Project scope** (recommended; each project can customize):

```bash
cd /path/to/your/laravel/project
mkdir -p .claude/agents
cp *.md .claude/agents/        # copy the 6 agent .md files here
```

**Option B — User scope** (available in every project):

```bash
mkdir -p ~/.claude/agents
cp *.md ~/.claude/agents/
```

Project agents override user agents when names collide.

## Step 2 — Verify

Start Claude Code in the project and run:

```
/agents
```

All agents should be listed. You can edit any of them from this menu too.

## Step 3 — Use the orchestrator flow

Just describe the feature at a high level. Claude (the main session = your
"project manager") will delegate based on each agent's description. Example:

```
Add a loyalty points feature: customers earn 1 point per $1 spent,
points are redeemable at checkout, and admins can adjust points
from Filament. Plan it, implement it, test it, and review it
before showing me the result.
```

Expected flow:
1. laravel-architect explores the codebase and writes the spec
2. db-expert designs the migrations (or implementer handles simple ones)
3. laravel-implementer builds the feature
4. test-runner runs the suite and reports failures
5. implementer fixes, test-runner re-verifies (the loop)
6. code-reviewer gives the final verdict
7. Main session summarizes everything for YOUR review

You can also invoke an agent explicitly:

```
Use the code-reviewer subagent to review my latest commit.
Use the db-expert subagent to optimize the orders dashboard query.
```

## Step 4 — Make delegation automatic (optional but powerful)

Add this to your project's CLAUDE.md so the orchestrator always follows
the pipeline without being told:

```markdown
## Workflow rules
- For any new feature: laravel-architect plans FIRST, then
  laravel-implementer builds, then test-runner verifies, then
  code-reviewer approves. Never skip review.
- Never show me code as "done" if code-reviewer returned
  CHANGES REQUIRED or test-runner reported failures.
- Database schema changes go through db-expert.
```

## Step 5 — Customize per project

Each agent file is plain Markdown — edit freely:
- Add project-specific conventions (e.g., "all money is stored in piasters
  as integers", "Filament panel is at /admin", "use Pest, not PHPUnit")
- Restrict tools further in the YAML `tools:` line for safety
- Add a `model:` field in frontmatter to route cheap tasks (test-runner)
  to a faster model and keep the strongest model for architect/reviewer

## Practical tips

- **Token cost**: subagent pipelines can use several times the tokens of a
  single session. Use the full pipeline for real features; for one-line
  fixes, just ask directly.
- **Context isolation**: subagents do NOT see your conversation. The
  orchestrator must pass file paths, decisions, and error messages in the
  delegation prompt — the agent descriptions above are written to remind
  it, but if a subagent seems "blind", that's why.
- **Trust but verify**: the code-reviewer catches a lot, but it is not a
  substitute for your own review before deploying — especially for
  payment flows (Paymob webhooks, HMAC validation).
- **Start small**: try the flow on one feature in one project first,
  tune the agent prompts based on what annoys you, then roll out to
  the other Build Syntax projects.

Docs: https://code.claude.com/docs/en/sub-agents
