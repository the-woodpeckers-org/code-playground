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
