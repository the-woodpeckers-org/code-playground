export function getAuth() {
    return localStorage.getItem('user');
}
export function setAuth(user) {
    localStorage.setItem('user', user);
}
