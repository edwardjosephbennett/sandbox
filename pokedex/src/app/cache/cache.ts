import fs from "fs-extra";

// 1 week in seconds
let cacheTime:number = 604800;

if(!fs.pathExists('../cache')) {
    console.log('path doesn\'t exist');
}
