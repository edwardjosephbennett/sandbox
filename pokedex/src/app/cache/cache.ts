import LocalForage from "localforage";

let isCached = (data:string) => {
	LocalForage.getItem(data).then((d) => {
		console.log(d);
		if(d === null) {
			console.log('data has not been cached');
			return false;
		}
		console.log('data has been cached');
		return true;
	}).catch((err) => {
		console.log(err);
	})
}

let createDateCache = () => {
	LocalForage.setItem('cacheDate', '');
}

let createCache = (key:any, data:any) => {
	LocalForage.setItem(key, data).then((value) => {
		console.log(value);
	})
}

export {
	isCached,
	createCache
}