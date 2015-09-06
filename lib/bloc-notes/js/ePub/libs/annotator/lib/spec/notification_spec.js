// Generated by CoffeeScript 1.6.3
describe('Annotator.Notification', function () {
    var notification;
    notification = null;
    beforeEach(function () {
        return notification = new Annotator.Notification();
    });
    afterEach(function () {
        return notification.element.remove();
    });
    it('should be appended to the document.body', function () {
        return assert.equal(notification.element[0].parentNode, document.body);
    });
    describe('.show()', function () {
        var message;
        message = 'This is a notification message';
        beforeEach(function () {
            return notification.show(message);
        });
        it('should have a class named "annotator-notice-show"', function () {
            return assert.isTrue(notification.element.hasClass('annotator-notice-show'));
        });
        return it('should update the notification message', function () {
            return assert.equal(notification.element.html(), message);
        });
    });
    return describe('.hide()', function () {
        beforeEach(function () {
            return notification.hide();
        });
        return it('should not have a class named "show"', function () {
            return assert.isFalse(notification.element.hasClass('show'));
        });
    });
});

/*
 //@ sourceMappingURL=notification_spec.map
 */