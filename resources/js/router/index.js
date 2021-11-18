import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from '../pages/home.vue';

import VersionList from '../pages/version/index.vue';
import CreateVersion from '../pages/version/create.vue';
import EditVersion from '../pages/version/edit.vue';

import ClassList from '../pages/class/index.vue';
import CreateClass from '../pages/class/create.vue';
import EditClass from '../pages/class/edit.vue';



import SubjectList from '../pages/subject/index.vue';
import CreateSubject from '../pages/subject/create.vue';
import EditSubject from '../pages/subject/edit.vue';



import QuizList from '../pages/quiz/index.vue';
import CreateQuiz from '../pages/quiz/create.vue';
import EditQuiz from '../pages/quiz/edit.vue';



const routes = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            component: Home,
            name: 'home',
        },
        {
            path: '/subject',
            component: SubjectList,
            name: 'subject-list',
        },
        {
            path: '/subject/create',
            component: CreateSubject,
            name: 'create-subject',
        },
        {
            path: '/subject/edit',
            component: EditSubject,
            name: 'edit-subject',
        },
        {
            path: '/version',
            component: VersionList,
            name: 'version-list',
        },
        {
            path: '/version/create',
            component: CreateVersion,
            name: 'create-version',
        },
        {
            path: '/version/edit',
            component: EditVersion,
            name: 'edit-version',
        },
        {
            path: '/class',
            component: ClassList,
            name: 'class-list',
        },
        {
            path: '/class/create',
            component: CreateClass,
            name: 'create-class',
        },
        {
            path: '/class/edit',
            component: EditClass,
            name: 'edit-class',
        },

        {
            path: '/quiz',
            component: QuizList,
            name: 'quiz-list',
        },
        {
            path: '/quiz/create',
            component: CreateQuiz,
            name: 'create-quiz',
        },
        {
            path: '/quiz/edit',
            component: EditQuiz,
            name: 'edit-quiz',
        }
    ]

});



export default routes;
