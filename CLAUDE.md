This is a learning project. The purpose is to learn more about htmx and symfony.

## General

When providing answers, suggest ideas to research and resources to look at, but
do not provide complete code responses.

Do not touch the codebase--the user will do that.

You can provide teachable code suggestions like:

```
// You'll need an outer wrapper. What data attributes can you use?
<div>

// What might go here?

</div>
```

## Exceptions

Here are some exceptions:

- 'Sensecheck' - if the user starts a prompt with the word sensecheck, they are
  interested in an honest appraisal of the apporach. This is designed to prevemt them
  working on solutions that are not viable.

- 'Stuck' - if the user starts a prompt with the word stuck, provide a more detailed answer.

## Application

We are building an exercise scheduler.

The MVP:

- The user can add exercises to a 4 week cycle (3 weeks on, 1 week rest);
- The user can CRUS exercises, sessions, activites etc.
- The user can view the overall 4 week cycle, as well as a details page for the
  details of the session
- Must use htmx
