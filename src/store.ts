import Vue from 'vue';
import Vuex from 'vuex';
import axios, {AxiosResponse} from 'axios';
import {Stage, Survey, SurveySubmission, SurveySubmissionImage} from '@/models';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    surveyUuid: '',
    submissionUuid: '',
    long_images: [] as SurveySubmissionImage[],
    short_images: [] as SurveySubmissionImage[],
    practise_images: [] as SurveySubmissionImage[],
    timeoutShort: 0,
    timeoutLong: 0,
    index: {
      practise: 0,
      short: 0,
      long: 0,
    },
    online: true,
  },
  getters: {
    surveyUuid: (state) => state.surveyUuid,
    shortImages: (state) => state.short_images,
    longImages: (state) => state.long_images,
    practiseImages: (state) => state.practise_images,
    timeoutShort: (state) => state.timeoutShort,
    timeoutLong: (state) => state.timeoutLong,
    currentPractiseIndex: (state) => state.index.practise,
    currentShortIndex: (state) => state.index.short,
    currentLongIndex: (state) => state.index.long,
    online: (state) => state.online,
  },
  mutations: {
    SET_SUBMISSION_UUID(state, submissionUuid) {
      state.submissionUuid = submissionUuid;
    },
    SET_SURVEY_UUID(state, surveyUuid) {
      state.surveyUuid = surveyUuid;
    },
    SET_TIMEOUT_LONG(state, timeout) {
      state.timeoutLong = timeout;
    },
    SET_TIMEOUT_SHORT(state, timeout) {
      state.timeoutShort = timeout;
    },
    SET_IMAGES_PRACTISE(state, images) {
      state.practise_images = images;
    },
    SET_IMAGES_LONG(state, images) {
      state.long_images = images;
    },
    SET_IMAGES_SHORT(state, images) {
      state.short_images = images;
    },
    INC_CURRENT_STAGE_INDEX(state, stage: Stage) {
      state.index[stage] = state.index[stage] + 1;
    },
    SET_OFFLINE(state) {
      state.online = false;
    },
  },
  actions: {
    createSubmission({commit, state}, {age, name}) {
      if (!state.surveyUuid) {
        return;
      }

      const data = new FormData();
      data.append('survey_uuid', state.surveyUuid);
      data.append('age', age);
      data.append('name', name);

      return axios({
        method: 'post',
        url: `${process.env.VUE_APP_API_HOST}/submission`,
        data,
        headers: {'Content-Type': 'multipart/form-data'},
      }).then((response: AxiosResponse<SurveySubmission>) => {
        commit('SET_SUBMISSION_UUID', response.data.uuid);
        commit('SET_IMAGES_LONG', response.data.images.filter((img) => img.stage === 'long'));
        commit('SET_IMAGES_SHORT', response.data.images.filter((img) => img.stage === 'short'));
        commit('SET_IMAGES_PRACTISE', response.data.images.filter((img) => img.stage === 'practise'));
      });
    },
    setSurveyUuid({commit}, uuid) {
      return axios({
        method: 'get',
        url: `${process.env.VUE_APP_API_HOST}/survey/${uuid}`,
      }).then((response: AxiosResponse<Survey>) => {
        commit('SET_SURVEY_UUID', uuid);
        commit('SET_TIMEOUT_SHORT', response.data.timeout_short);
        commit('SET_TIMEOUT_LONG', response.data.timeout_long);
      });
    },
    answerQuestion({commit, state}, {uuid, fake, stage}) {
      const data = new FormData();
      data.append('image_uuid', uuid);
      data.append('fake', fake);
      data.append('stage', stage);

      return axios({
        method: 'post',
        url: `${process.env.VUE_APP_API_HOST}/submission/${state.submissionUuid}/answer`,
        data,
        headers: {'Content-Type': 'multipart/form-data'},
      }).then(() => {
        commit('INC_CURRENT_STAGE_INDEX', stage);
      });
    },
    submitSurvey({state}) {
      return axios({
        method: 'post',
        url: `${process.env.VUE_APP_API_HOST}/submission/${state.submissionUuid}/submit`,
      });
    },
    checkOnline({commit}) {
      return axios({
        method: 'get',
        url: `${process.env.VUE_APP_API_HOST}/`,
      }).catch(() => commit('SET_OFFLINE'));
    },
  },
});
