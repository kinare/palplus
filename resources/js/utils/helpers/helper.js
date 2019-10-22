import moment from "moment/moment";

class Helper {
  isEmpty(obj) {
    for (var prop in obj) {
      if (obj.hasOwnProperty(prop)) return false;
    }
    return true;
  }

  prepareFormData(formData) {
    let data = new FormData();
    for (let key in formData) {
      if (formData[key] === null) formData[key] = "";
      data.append(key, formData[key]);
    }
    return data;
  }

  dateFix(date) {
    if (date) {
      if (
        moment(date, "YYYY-MM-DD HH:mm:ss").format("YYYY-MM-DD HH:mm:ss") ===
        date
      )
        return date;
      let d = new Date(
        Date.UTC(
          date.getFullYear(),
          date.getMonth(),
          date.getDate(),
          date.getHours() - 3,
          date.getMinutes(),
          date.getSeconds()
        )
      );
      return moment(d).format("YYYY-MM-DD HH:mm:ss");
    }
    return "";
  }
}
export default Helper;
