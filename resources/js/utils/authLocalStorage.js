export function getAuth() {
    return localStorage.getItem('user');
}

export function getAccessToken() {
    return localStorage.getItem('accessToken');
}

export function setAccessToken(accessToken) {
    localStorage.setItem('accessToken', accessToken);
}


export function setAuth(user) {
    localStorage.setItem('user', user);
}
