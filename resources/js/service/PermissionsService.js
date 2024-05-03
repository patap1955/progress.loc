export default class PermissionsService {
    getPermissions() {
        return  fetch('/api/permissions', {
            method: 'GET',
        })
            .then((res) => res.json())
    }
}
