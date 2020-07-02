import Axios from "axios";

export let getPokemon = (url:string = '') => {
	Axios
		.get(url)
		.then((result) => {
			if(result.status === 200) {
				console.log(result);
				return result;
			}
			return false;
		})
}