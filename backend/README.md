# Backend design API

## Survey
### POST /survey

Requires `title`, `description`.

Returns the created survey

### GET /survey/{id}

Returns the description title, description and images.

### POST /survey/{id]/images

Add a new image to the survey

## Submission
### POST /submission

Requires `name`.

Returns id of the created submission and a list of images for practise and reals.

### GET /submission/{submission_uuid}

Returns the submission with progress

### POST /submission/{submission_uuid}/{question_uuid}

Set the answer on a question

### POST /submission/{submission_id}/submit

Mark a submission as submitted.

# Models

## Survey

A survey category allowing for multiple different surveys.

|||
|---|---|
|id|int
|uuid|uuid
|title|string

## SurveyImage

An image in a survey. Containing a boolean to determine if the image is a fake.

|||
|---|---|
|id|int
|survey|int
|uuid|uuid
|fake|bool

## SurveySubmission

A submission by a user.

|||
|---|---|
|id|int
|uuid|uuid
|name|string
|submitted|bool

## SurveySubmissionImage

A single answer to a survey.

|||
|---|---|
|id|int
|survey_id|int
|image_id|int
|fake|bool
