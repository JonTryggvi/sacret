## Git Workflow Rules
- After implementing requested changes, if this directory is a Git repo, create a local commit.
- If the task is analysis-only and no files were changed, skip commit.
- Commit only files changed for the task.
- Use one commit per task.
- Use a concise conventional message: `feat: ...`, `fix: ...`, `chore: ...`.
- If unrelated dirty changes exist, do not include them unless I explicitly ask. Stop and ask first before proceeding.
- Never push unless I explicitly ask.

## General coding rules

For any code you generate during this session, please keep the following preferences in mind:

General Coding Style:
* Indentation: Use 2 spaces for indentation.
* Switch Statements: Never use `switch` statements. Use an Object literal in JavaScript or an associative array in PHP instead.

***Provided Code:*** If you are providing a partial code block, please mark it with **ATTENTION** to make it noticeable. Use placement anchors for every code block.

***Refactoring:*** Please refrain from refactoring or changing code while we are adding features. Refactoring should only take place when we have a working solution to our problem.

For PHP Code Specifically:
1.  Array Syntax: Use the short array syntax (`[]`) instead of `array()`.
2.  PHP Version: Target PHP 8.0+ standards, features, and syntax.
3.  Type Checking:
    * Implement proper type checking by including scalar type declarations (e.g., `int`, `string`, `bool`, `float`) for function/method parameters.
    * Include return type declarations for functions/methods.
    * Use property type declarations in classes.
    * However, please do not include `declare(strict_types=1);` at the beginning of PHP snippets unless specifically asked.
4.  String Syntax: Use 'Heredoc' (`<<<EOT...EOT;`) or the appropriate (`<<<HTML ... HTML` for HTML) or (`<<<XML ... XML`) ect when working with multi-line strings, especially those containing other programming languages like SQL, HTML, or JavaScript.
5.  Structure: When generating complex code solutions (e.g., an action that gets results and handles errors/success), build the solution as a Class. Avoid global functions unless they can be useful in a global context.
6. Do not add closing PHP tags to code that is purely PHP '?>'

For JavaScript & Other Languages:
* String Syntax: Use the language's modern, native syntax for multi-line strings, such as Template Literals (backticks `` ` ``) in JavaScript.

Interaction Style:
* Please do not make apologies but strive to get to the root of our problems. Let's not waste text space on that.
* Steer clear of sycophancy. Not all my ideas are great, and I want to know when I am out of line.
* Please do not offer "If you want me to be able to save or delete info about you, turn on the feature on the Saved info page." unless it is available in my region.
* Please ask me to clarify if you find my prompt to be ambiguous or unclear before providing any code.

Please apply these preferences. Thanks!!!

## WordPress Plugin Scaffold Rule

If the task is to create, scaffold, modernize, or significantly extend a WordPress plugin, use `Avista-Care-Dashboard` in this workspace as the default structural reference unless the user explicitly requests a different pattern.

### Required discovery
Before building, ask for any missing items:
- Plugin name
- Plugin slug
- GitHub repository URL
- Short plugin purpose
- Required features: admin UI, settings page, REST API, OAuth, updater, dashboard widgets, scheduled tasks

Do not guess these if they are important to bootstrap, packaging, or updater configuration.

### Required structure
Default to this structure:
- Root plugin bootstrap file
- `admin/` for admin controllers, REST controllers, admin UI classes, templates, and feature integrations
- `includes/` for settings/config/support classes
- `vendor/` for Composer dependencies only
- One class per file where practical
- Bootstrap file should require dependencies and instantiate the main classes
- Keep hooks inside classes, not spread through the bootstrap file

### Required repo/release checks
When building or updating a plugin:
- Inspect the GitHub repo configuration if a repo exists
- Inspect `.github/workflows/`
- Update outdated GitHub Actions workflow syntax or deprecated action versions
- Ensure release/build workflows still match the plugin’s packaging strategy
- Ensure any GitHub-based updater configuration points at the correct repository
- Flag missing workflow/release automation if expected but absent

### Implementation rules
- Match the coding style and organizational clarity of `Avista-Care-Dashboard`
- Prefer pragmatic class-based WordPress architecture
- Register REST routes through dedicated controller classes
- Put settings logic in dedicated settings/admin classes
- Avoid unnecessary abstraction
- Use `apply_patch` for edits
- Run PHP syntax validation after PHP changes
- Do not claim release automation is correct unless it was actually inspected

### Output requirements
At the end, report:
- What structure was created or changed
- What repo/workflow checks were performed
- Any assumptions made because the user did not provide required plugin/repo details
- Any verification not completed
