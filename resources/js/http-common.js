export const HTTP = axios.create({
    baseURL: `/`,
    headers: {'Accept': 'application/json', 'Authorization': 'Bearer ' + localStorage.accessToken}
})
