import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        surveyUuid: '',
        submissionUuid: '',
        practise_questions: [],
        questions: [],
    },
    getters: {
        questions: (state) => state.questions,
        practise_questions: (state) => state.practise_questions,
    },
    mutations: {
        SET_QUESTIONS(state, questions) {
            state.questions = questions;
        },
        SET_SUBMISSION_UUID(state, submissionUuid) {
            state.submissionUuid = submissionUuid;
        },
        SET_SURVEY_UUID(state, surveyUuid) {
            state.surveyUuid = surveyUuid;
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

            axios({
                method: 'post',
                url: `${process.env.VUE_APP_API_HOST}/submission`,
                data,
                headers: {'Content-Type': 'multipart/form-data'},
            }).then((response) => {
                commit('SET_SUBMISSION_UUID', response.data.uuid);
            });
        },
        setSurveyUuid({commit}, uuid) {
            commit('SET_SURVEY_UUID', uuid);
        },
    },
});
