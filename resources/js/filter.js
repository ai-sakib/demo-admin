import moment from 'moment'
import Vue from 'vue'

Vue.filter('timeformat',(argument)=>{
	return moment(argument).format("MMM Do YY"); 
})