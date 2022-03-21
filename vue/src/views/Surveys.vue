<template>
	<PageComponent > 
		<template v-slot:header>
			<div class="flex items-center justify-between">
				<h1 class="text-3xl font-bold text-gray-900">
					Surveys
				</h1>		
				<router-link
				:to="{ name: 'SurveysCreate' }"
				class="py-2 px-3 text-white rounded-md bg-green-500 hover:bg-green-600 duration-300 flex flex-row items-center space-x-2"
				>
				<PlusIcon class="w-5 h-5" />
				Add new Survey
			</router-link>
		</div>
	</template>
	<div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3">
		<div v-for="survey in surveys" class="flex flex-col space-y-3 px-4 py-2 rounded-md shadow-md bg-white hover:bg-gray-50">
			<img :src="survey.image" :alt="survey-title" class="w-4-full object-cover h-48">
			<h4 class="text-lg font-semibold">{{ survey.title }} </h4>
			<div v-html="survey.description" class="overflow-hidden flex-1"></div>
			<div class="flex flex-row justify-between items-center text-white">
				<router-link :to="{ name: 'SurveyView', params: { id: survey.id }} "
				class="bg-orange-400 flex py-2 px-4 border border-transparent text-sm rounded-md hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 flex-row items-center space-x-2">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
				</svg>
				Edit
			</router-link>
			<button v-if="survey.id"
			type="button"
			@click="deleteSurvey(survey)" 
			class="text-red-600 flex h-8 w-8 border border-red-500 text-sm rounded-full justify-center items-center p-1  hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
			<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
				<path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
			</svg>
			
		</button>
	</div>
</div>
</div>
</PageComponent>

</template>
<script setup>
	import store from '../store';
	import { computed } from 'vue';
	const surveys = computed(() => store.state.surveys);
	import {PlusIcon} from "@heroicons/vue/solid"

	import PageComponent from '../components/PageComponent.vue'
</script>
<style></style>