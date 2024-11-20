import {HTTP} from "@/http-common.js";

export function getAuth() {
    return JSON.parse(localStorage.getItem('user'));
}

export function getAccessToken() {
    return localStorage.getItem('accessToken');
}

export function setAccessToken(accessToken) {
    localStorage.setItem('accessToken', accessToken);
}

export function setAuth(user) {
    localStorage.setItem('user', JSON.stringify(user));
}

export async function renewAuth() {
    await HTTP.get('api/auth/get')
        .then((response) => {
            setAuth(response.data);
        })
        .catch((err) => {
            console.log(err);
        })
}
