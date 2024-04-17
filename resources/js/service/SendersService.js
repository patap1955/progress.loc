export default class SendersService {
    getServices() {
        return  fetch('/api/senders', {
            method: 'GET',
        })
            .then((res) => res.json())
    }

    getSenderMessages(id) {
        return  fetch('/api/sender/' + id, {
            method: 'GET',
        })
            .then((res) => res.json())
    }
}
