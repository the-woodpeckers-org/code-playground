export const HTTP = axios.create({
    baseURL: `/`,
    headers: {'Access-Control-Allow-Origin': '*','Accept': 'application/json', 'Authorization': 'Bearer ' + localStorage.getItem("accessToken")}
})
