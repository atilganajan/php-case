class AlertMessages {
    static showAlerts(messages, icon, timer) {
        let showMessages = "";
        messages.forEach(message => {
            showMessages +=`${message} <br>`
        });

        Swal.fire({
            icon: icon,
            html: showMessages,
            showConfirmButton: false,
            timer: timer
        });
    }

    static showSuccess(messages, timer) {
        this.showAlerts(messages, "success", timer);
    }

    static showError(messages, timer) {
        this.showAlerts(messages, "error", timer);
    }

    static showWarning(messages, timer) {
        this.showAlerts(messages, "warning", timer);
    }

    static showInfo(messages, timer) {
        this.showAlerts(messages, "info", timer);
    }
}
