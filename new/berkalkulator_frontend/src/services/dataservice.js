import Axios from "axios";

const instance = Axios.create({
    withCredentials: true,
    baseURL: 'http://localhost:8000/',
    headers: {
        'Content-type': 'application/json'
    },
});

export default instance;