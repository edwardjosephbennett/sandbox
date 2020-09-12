import * as a from './src/app';
import "@babel/polyfill";
import App from "./src/components/App.svelte"

let appContainer: HTMLElement | any = document.querySelector('#app');

console.log(a.core.config);

const app = new App({
	target: appContainer
})