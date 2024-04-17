export default class MessageService {
    getMessage(sender, message) {
        return  fetch('/api/sender/' + sender + '/message/' + message, {
            method: 'GET',
        })
            .then((res) => res.json())
    }
}
