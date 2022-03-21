import {createStore} from 'vuex';
import axiosClient from '../axios'

const tmpSurveys = [
{
	id:100,
	title: "Kemasan 1",
	slug: "kemasan-1",
	status: "draft",
	image: "https://dikemas.com/uploads/2019/03/apa-pentingnya-kemasan-yang-apik-bagi-suatu-produk.jpg",
	description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's",
	created_at: "2022-3-20 18:00:00",
	updated_at: "2022-3-21 18:00:00",
	expire_date: "2022-3-31 18:00:00",
	questions: [
	{
		id:1,
		type: "select",
		question: "From which country are you?",
		description: null,
		data: {
			options: [
			{
				uuid: "d3ca32be-a8d9-11ec-b909-0242ac120002",
				text: "Indonesia"
			},
			{
				uuid: "de830370-a8d9-11ec-b909-0242ac120002",
				text: "Malay"
			}
			],
		}
	},
	{
		id:2,
		type: "select",
		question: "How old are you?",
		description: null,
		data: {
			options: [
			{
				uuid: "d3ca32be-a8d9-11ec-b909-0242ac120002",
				text: "21"
			},
			{
				uuid: "de830370-a8d9-11ec-b909-0242ac120002",
				text: "25"
			}
			],
		}
	}
	]

},
{
	id:200,
	title: "Kemasan 2",
	slug: "kemasan-2",
	status: "draft",
	image: "https://flexypack.com/wp-content/uploads/2020/02/yang-harus-diperhatikan-dalam-membuat-desain-kemasan-produk.jpg",
	description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's",
	updated_at: "2022-3-21 18:00:00",
	expire_date: "2022-3-31 18:00:00",
	questions: [
	{
		id:1,
		type: "select",
		question: "From which country are you?",
		description: null,
		data: {
			options: [
			{
				uuid: "basdkhkjasdkjhaskldncxzc",
				text: "Indonesia",
			},
			{
				uuid: "sabkjbnjcjknzxczx",
				text: "Malay",
			}
			],
		}
	}]

},

]

const store = createStore({
	state : {
		user: {
			data: {},
			token: sessionStorage.getItem('TOKEN'),
		},
		surveys: [...tmpSurveys],
		questionTypes: ["text", "select", "radio", "checkbox", "textarea"],
	},
	getters: {},
	actions: {
		register({ commit }, user){
			return axiosClient.post('/register', user)
			.then(({data}) => {
				commit('setUser', data.user)
				commit('setToken', data.token)
				return data;
			})
		},
		login ({ commit }, user){
			return axiosClient.post('/login', user)
			.then(({data}) => {
				commit('setUser', data.user)			
				commit('setToken', data.token)	
				return data;
			})
		},
		logout({commit}) {
			return axiosClient.post('/logout')
			.then(response => {
				commit('logout')
				return response;
			})
		},

		
	},
	mutations: {
		logout: (state) => {
			state.user.token = null;
			state.user.data = {};
			sessionStorage.removeItem("TOKEN");
		},
		setUser: (state, user) => {
			state.user.data = user;			
		},
		setToken: (state, token) => {
			state.user.token = token;
			sessionStorage.setItem('TOKEN', token);
		}
	},
	modules: {}

})

export default store;