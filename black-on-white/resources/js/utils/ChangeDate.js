import moment from 'moment/min/moment-with-locales';

export function changeDate(datetime) {
    moment.locale('ru');

    const date = new Date(datetime);
    const diff = moment.duration(moment().diff(date));

    if (diff.asMinutes() < 60) {
        let result = (new Date()).getTime() - date.getTime();
        result = (new Date(result)).getMinutes();
        return `${result} минут назад`;
    }
    if (diff.asHours() < 24) {
        return moment().subtract(diff).format('HH часов назад');
    }
    if (diff.asDays() < 2) {
        return moment().subtract(diff).format('Вчера в HH:mm');
    }
    return moment(date).format('D MMMM в HH:mm YYYY');
}
