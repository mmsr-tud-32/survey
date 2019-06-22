import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    surveyUuid: '',
    submissionUuid: '',
    long_images: [],
    short_images: [],
    practise_images: [],
    timeoutShort: 0,
    timeoutLong: 0,
    currentPractiseIndex: 0,
    currentShortIndex: 0,
    currentLongIndex: 0,
  },
  getters: {
    shortImages: (state) => state.short_images,
    longImages: (state) => state.long_images,
    practiseImages: (state) => state.practise_images,
    timeoutShort: (state) => state.timeoutShort,
    timeoutLong: (state) => state.timeoutLong,
    currentPractiseIndex: (state) => state.currentPractiseIndex,
    currentShortIndex: (state) => state.currentShortIndex,
    currentLongIndex: (state) => state.currentLongIndex,
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
    INC_CURRENT_PRACTISE_INDEX(state) {
      state.currentPractiseIndex = state.currentPractiseIndex + 1;
    },
    INC_CURRENT_SHORT_INDEX(state) {
      state.currentShortIndex = state.currentShortIndex + 1;
    },
    INC_CURRENT_LONG_INDEX(state) {
      state.currentLongIndex = state.currentLongIndex + 1;
    },
  },
  actions: {
    createSubmission({commit, state}, name) {
      if (!state.surveyUuid) {
        return;
      }

      const data = new FormData();
      data.append('survey_uuid', state.surveyUuid);
      data.append('name', name);

      return axios({
        method: 'post',
        url: `${process.env.VUE_APP_API_HOST}/submission`,
        data,
        headers: {'Content-Type': 'multipart/form-data'},
      }).then((response) => {
        commit('SET_SUBMISSION_UUID', response.data.uuid);
        commit('SET_IMAGES_LONG', response.data.long_images);
        commit('SET_IMAGES_SHORT', response.data.images);
        commit('SET_IMAGES_PRACTISE', response.data.practise_images);
      });
    },
    setSurveyUuid({commit}, uuid) {
      return axios({
        method: 'get',
        url: `${process.env.VUE_APP_API_HOST}/survey/${uuid}`,
      }).then((response) => {
        commit('SET_SURVEY_UUID', uuid);
        commit('SET_TIMEOUT_SHORT', response.data.timeout_short);
        commit('SET_TIMEOUT_LONG', response.data.timeout_long);
      });
    },
    answerPractiseQuestion({commit, state}, {uuid, fake}) {
      const data = new FormData();
      data.append('image_uuid', uuid);
      data.append('fake', fake);

      return axios({
        method: 'post',
        url: `${process.env.VUE_APP_API_HOST}/submission/${state.submissionUuid}/answer_practise`,
        data,
        headers: {'Content-Type': 'multipart/form-data'},
      }).then(() => {
        commit('INC_CURRENT_PRACTISE_INDEX');
      });
    },
    answerShortQuestion({commit, state}, {uuid, fake}) {
      const data = new FormData();
      data.append('image_uuid', uuid);
      data.append('fake', fake);

      return axios({
        method: 'post',
        url: `${process.env.VUE_APP_API_HOST}/submission/${state.submissionUuid}/answer_short`,
        data,
        headers: {'Content-Type': 'multipart/form-data'},
      }).then(() => {
        commit('INC_CURRENT_SHORT_INDEX');
      });
    },
    answerLongQuestion({commit, state}, {uuid, fake}) {
      const data = new FormData();
      data.append('image_uuid', uuid);
      data.append('fake', fake);

      return axios({
        method: 'post',
        url: `${process.env.VUE_APP_API_HOST}/submission/${state.submissionUuid}/answer_long`,
        data,
        headers: {'Content-Type': 'multipart/form-data'},
      }).then(() => {
        commit('INC_CURRENT_LONG_INDEX');
      });
    },
    submitSurvey({state}) {
      return axios({
        method: 'post',
        url: `${process.env.VUE_APP_API_HOST}/submission/${state.submissionUuid}/submit`,
      });
    },
  },
});
