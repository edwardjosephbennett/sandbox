import getPokemon from "./src/ts/getPokemon";
import './src/ts/cache';

let appContainer: HTMLElement | any = document.querySelector('#app');

getPokemon();