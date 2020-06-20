// import axios from 'axios'
// axios.defaults.baseURL = '/superblog'

export default {
	state:{
		roles:[],
	},
	getters:{
		getRoles(state){
			return state.roles
		},
		
	},
	actions:{
		getRoles(context){
			axios.get('roles')
				.then((response)=>{
					context.commit('getRoles', response.data.roles)
				})
		},
	},
	mutations:{
		getRoles(state, data){
			return state.roles = data
		},
	},
}