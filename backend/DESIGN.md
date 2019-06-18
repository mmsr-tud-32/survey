# Backend design API

## POST /survey/create

Returns a unique identifier for this session, is a uuid. 

## GET /survey/{id}/description

Returns the description title and body.

## GET /survey/{id}/practise-questions

Returns a list of questions for practise.

## GET /survey/{id}/questions

Returns a list of questions. Each question contains an image id, image location and a timeout.

## GET /survey/{id}/current

Returns the identifier for the current position of the survey.

## POST /survey/{id}/answer/{image_id}

Update the answer for a specific survey/image combo.

## POST /survey/{id}/submit


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
