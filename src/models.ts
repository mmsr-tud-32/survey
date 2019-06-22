export interface Survey {
  uuid: string;
  title: string;
  description: string;
  timeout_short: number;
  timeout_long: number;
}

export interface SurveySubmission {
  uuid: string;
  name: string;
  age: number;
  submitted: boolean;
  images: SurveySubmissionImage[];
}

export interface SurveySubmissionImage {
  fake?: boolean;
  image: SurveyImage;
  stage: Stage;
}

export interface SurveyImage {
  uuid: string;
  image: string;
}

export type Stage = 'practise' | 'short' | 'long';
