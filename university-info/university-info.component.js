function universityInfoController($http, $location) {

    this.bw = [];
    this.mysearch = '';
    this.mypage = 1;
    this.total = 0;
    // functions that call the DB and return the data.
    this.dbCall = (Search,Page) => {
        let qry = '?search=' + Search +'&page=' + Page ;
        $http.get('./DBcontrol/search.php' + qry)
            .then( (response) => {
                return response.data;
            }, err => {
                console.log('error :', err);
            }).then((data) => {
                this.bw = data;
            });
    };

    this.pag = () => {
        $http.get('./DBcontrol/search.php?type=1')
            .then( (response) => {
                return response.data;
            }, err => {
                console.log('error :', err);
            }).then((data) => {
            this.total = data;
        });
    };

    this.removeme = (id) => {
        $http.post('./DBcontrol/connection_update.php?action=remove&id=' + id)
            .then( (response) => {
                return response.data;
            }, err => {
                console.log('error :', err);
            }).then((data) => {
                $('#'+id).css('display','none');
                console.log(data);
        });
    };
    this.dbCall(this.mysearch,this.mypage,0);
    this.pag();

    this.editme = (id) => {
        $location.path('/update/' + id);
    }
}

app.component('universityInfo', {
    templateUrl: 'university-info/university-info.html',
    controller: universityInfoController,
    controllerAs: 'vm'
});