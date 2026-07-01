# HtmeXcel

Working locally:

Start the app:
`symfony server:start`
Start the db:
`docker compose up -d --remove-orphan`

PHPCS:

$ ./vendor/bin/php-cs-fixer fix
$ ./vendor/bin/php-cs-fixer check

## Data strucutre

Sport
name string 100 not null
icon string 50 nullable
color string 7 nullable

ExerciseType
name string 100 not null
category string 50 nullable
sport relation → ManyToOne → Sport not null yes (add to Sport.exerciseTypes)

Exercise
name string 200 not null
description text nullable
defaultMetrics json nullable
type relation → ManyToOne → ExerciseType not null yes

MetricDefinition
name string 100 not null
unit string 30 not null (e.g. "kg", "min/km", "m")
type string 20 not null (e.g. "integer", "float", "duration", "text")
sport relation → ManyToOne → Sport not null yes

Program
name string 200 not null
description text nullable
startDate date nullable
endDate date nullable
status string 20 not null (default "draft")

ProgramWeek
weekNumber integer not null
status string 20 not null (default "normal")
notes text nullable
program relation → ManyToOne → Program not null yes (orphanRemoval)

Session
dayOfWeek integer not null
position integer not null (default 0)
status string 20 not null (default "planned")
notes text nullable
week relation → ManyToOne → ProgramWeek not null yes (orphanRemoval)
sport relation → ManyToOne → Sport not null no

Activity
position integer not null (default 0)
metrics json nullable
notes text nullable
session relation → ManyToOne → Session not null yes (orphanRemoval)
exercise relation → ManyToOne → Exercise not null no

Goal
title string 200 not null
type string 50 not null (e.g. "performance", "volume", "habit")
targetValue float nullable
unit string 50 nullable
notes text nullable
program relation → ManyToOne → Program not null yes
week relation → ManyToOne → ProgramWeek nullable no
sport relation → ManyToOne → Sport nullable no
