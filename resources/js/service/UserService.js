export default class UserService {
    getAllUsers() {
        return  fetch('/api/users', {
            method: 'GET',
        })
            .then((res) => res.json())
    }
}
