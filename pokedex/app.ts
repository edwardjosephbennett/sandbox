import * as P from './src/app';

let appContainer: HTMLElement | any = document.querySelector('#app');
console.log(P.config);

P.getPokemon();