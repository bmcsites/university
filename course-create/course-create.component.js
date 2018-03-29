function courseCreateController($http, $state, $stateParams) {
    this.id = $stateParams.id;
    this.course = [];
    console.log(this.id);

    this.getCourseById = (id) => {
        $http.get('./DBcontrol/getCourse.php?id=' + id)
            .then( (response) => {
                return response.data;
            }, err => {
                console.log('error :', err);
            }).then((data) => {
            this.course = data[0];
        });
    };
    this.getCourseById(this.id);

    console.log(document.getElementsByTagName('input')[8].name);
}

app.component('courseCreate', {
    templateUrl: 'course-create/course-create.html',
    controller: courseCreateController,
    controllerAs: 'vm'
});