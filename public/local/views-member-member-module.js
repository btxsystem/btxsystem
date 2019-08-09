(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["views-member-member-module"],{

/***/ "./src/app/views/member/member-nonactive.component.html":
/*!**************************************************************!*\
  !*** ./src/app/views/member/member-nonactive.component.html ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"animated fadeIn\">\r\n\r\n    <div class=\"row\" >\r\n        <div class=\"col-lg-12\">\r\n            <div class=\"card\">\r\n                <div class=\"card-header\">\r\n                    <i class=\"fa fa-align-justify\"></i> {{moduleName}}\r\n\r\n                    <span class=\"float-right\">\r\n                            <button *appHasPermission=\"modulePermission+'Create'\" class=\"btn btn-primary btn-sm\" (click)=\"addData();mapsModal.show()\">\r\n                                <i class=\"fa fa-plus\"></i> Add New</button>&nbsp;\r\n                        </span>\r\n                </div>\r\n\r\n                <!--div class=\"card-body\">\r\n                    <button class=\"btn btn-primary btn-sm\" (click)=\"addData()\"><i class=\"fa fa-plus\"></i> Add New</button>&nbsp;\r\n                </div-->\r\n\r\n                <!--serch-->\r\n                <div class=\"card-body\">\r\n                    <form class=\"form-horizontal\">\r\n                        <div class=\"row\">                           \r\n                            \r\n                            <!-- <div class=\"col-sm-5\">&nbsp;</div> -->\r\n                            <div class=\"col-sm-3\">\r\n\r\n                                <div class=\"form-group row\">\r\n                                    <!-- <label class=\"col-md-4 col-form-label\" for=\"f-perusahaan\">Member</label> -->\r\n                                    <div class=\"col-md-12\">\r\n                                        <ng-select [items]=\"dd.member\"\r\n                                            bindLabel=\"name\"\r\n                                            bindValue=\"id\"\r\n                                            placeholder=\"- Search Member -\"\r\n                                            [(ngModel)]=\"filter.id_member\"\r\n                                            #id_member=\"ngModel\"\r\n                                            name=\"id_member\"\r\n                                        >\r\n                                        </ng-select>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n\r\n                            <div class=\"col-md-3\">\r\n                                <button type=\"button\" class=\"btn btn-sm btn-primary\" (click)=\"doSearch()\"><i class=\"fa fa-search\"></i> Filter</button>&nbsp;\r\n\r\n                                <button type=\"button\" class=\"btn btn-sm btn-primary\" (click)=\"clearSearch()\"><i class=\"fa fa-ban\"></i> UnFilter</button>&nbsp;\r\n                            </div>\r\n                        </div>\r\n                    </form>\r\n                </div>\r\n\r\n                <div class=\"card-body\">\r\n                    <div *ngIf=\"loading\" class=\"text-warning mb-0 mt-2\"><i class=\"fa fa-circle-o-notch fa-spin\"></i> Loading Data...</div>\r\n\r\n                    <table *ngIf=\"!loading\" class=\"table table-hover table-striped table-sm\">\r\n                        <thead>\r\n                            <tr>\r\n                                <th>No.</th>\r\n                                <th>ID Member</th>\r\n                                <th>Name</th>\r\n                                <th>HP</th>\r\n                                <th>Rank</th>\r\n                                <th>Status</th>\r\n                                <th>Action</th>\r\n                            </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                            <tr *ngFor=\"let row of data | paginate: { id: 'member',\r\n                            itemsPerPage: pageSize,\r\n                            currentPage: currentPage,\r\n                            totalItems: totalItems}; let i = index\">\r\n                                <td>{{ i+1 }}</td>\r\n                                <td>{{ row.id_member }}</td>\r\n                                <td>{{ row.first_name +' '+row.last_name }}</td>\r\n                                <td>{{ row.phone_number }}</td>\r\n                                <td>{{ row.rank ? row.rank.name : '' }}</td>\r\n                                <td *ngIf=\"row.status == 1\">Active</td>\r\n                                <td *ngIf=\"row.status == 0\">Nonactive</td>\r\n                                <td>\r\n                                    <button type=\"button\" class=\"btn btn-warning btn-sm\" (click)=\"editData(row); mapsModal.show();\"><i class=\"fa fa-pencil-alt\"></i></button>&nbsp;\r\n                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" (click)=\"deleteData(row)\"><i class=\"fa fa-trash\"></i></button>&nbsp;\r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>\r\n\r\n                     <div class=\"pull-right\">\r\n                        <pagination-controls id=\"member\" previousLabel=\"\" nextLabel=\"\" autoHide=\"true\" (pageChange)=\"currentPage = $event\"></pagination-controls>\r\n                    </div>\r\n\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n    <div class=\"row\" *ngIf=\"!showList\">\r\n\r\n        \r\n    </div>\r\n</div>\r\n\r\n\r\n<!-- modal -->\r\n\r\n<div bsModal #mapsModal=\"bs-modal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"dialog-auto-name\">\r\n        <div class=\"modal-dialog modal-lg\">\r\n            <div class=\"modal-content\">\r\n    \r\n                <div class=\"modal-header\">\r\n                    <h4 id=\"dialog-auto-name\" class=\"modal-title pull-left\">{{moduleName}}</h4>\r\n                    <button type=\"button\" class=\"close pull-right\" aria-label=\"Close\" (click)=\"mapsModal.hide(); clearForm()\">\r\n                        <span aria-hidden=\"true\">&times;</span>\r\n                    </button>&nbsp;\r\n                </div>\r\n    \r\n                <div class=\"modal-body\">\r\n\r\n                    <div class=\"col-sm-12\">\r\n\r\n\r\n\r\n                        <form #f=\"ngForm\" novalidate (ngSubmit)=\"saveData(f.value, f.valid)\" class=\"form-horizontal\">\r\n\r\n                        <div class=\"card\">\r\n                            <div class=\"card-header\">\r\n                                <strong>{{moduleName}}</strong> Add/Edit\r\n                            </div>\r\n                            <div class=\"card-body\">\r\n\r\n                                <div class=\"row\">\r\n                                    <div class=\"col-sm-4\">\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">First Name</label>                                 \r\n                                            <input type=\"text\" id=\"first_name\" name=\"first_name\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.first_name\" #first_name=\"ngModel\" required>\r\n                                           \r\n                                        </div>\r\n                                        &nbsp;\r\n\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Last Name</label>       \r\n                                            <input type=\"text\" id=\"last_name\" name=\"last_name\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.last_name\" #last_name=\"ngModel\" required>\r\n                                         \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Gender</label>                                \r\n                                            \r\n                                             <select [(ngModel)]=\"form.gender\" #gender=\"ngModel\" id=\"gender\" required\r\n                                                    name=\"gender\" class=\"form-control\">\r\n                                                    <option *ngFor=\"let row of dd.gender\" [value]=\"row.id\">{{ row.name }}</option>\r\n                                            </select>\r\n                                          \r\n                                        </div>&nbsp;                            \r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Birth Date</label> \r\n                                            \r\n                                            <input type=\"text\" readonly bsDatepicker [bsConfig]=\"{ dateInputFormat: 'YYYY-MM-DD' }\"  id=\"birthdate\" name=\"birthdate\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.birthdate\" #birthdate=\"ngModel\" required>\r\n                                            \r\n                                        </div> &nbsp;                      \r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Married Status</label>     \r\n                                             <select [(ngModel)]=\"form.is_married\" #is_married=\"ngModel\" id=\"is_married\" required\r\n                                                    name=\"is_married\" class=\"form-control\">\r\n                                                    <option *ngFor=\"let row of dd.married\" [value]=\"row.id\">{{ row.name }}</option>\r\n                                            </select>\r\n                                            \r\n                                        </div>\r\n\r\n                                    </div>\r\n                                    <div class=\"col-sm-4\">\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Username</label>                               \r\n                                                <input type=\"text\" id=\"username\" name=\"username\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.username\" #username=\"ngModel\" required>\r\n                                            \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Password</label>                                 \r\n                                            <input type=\"text\" id=\"password\" name=\"password\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.password\" #password=\"ngModel\" required>\r\n                                            \r\n                                        </div>&nbsp;\r\n                                         <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Npwp Number</label> \r\n                                            \r\n                                                <input type=\"text\" id=\"npwp_number\" name=\"npwp_number\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.npwp_number\" #npwp_number=\"ngModel\" required>\r\n                                           \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">No Rekening</label> \r\n                                            \r\n                                                <input type=\"text\" id=\"no_rec\" name=\"no_rec\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.no_rec\" #no_rec=\"ngModel\" required>\r\n                                           \r\n                                        </div>&nbsp;\r\n                                        \r\n\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Email</label>                               \r\n                                            <input type=\"text\" id=\"email\" name=\"email\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.email\" #email=\"ngModel\" required>\r\n                                           \r\n                                        </div>&nbsp;\r\n                                                          \r\n\r\n                                    </div>\r\n                                    <div class=\"col-sm-4\">\r\n                                          <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Phone Number</label>                                 \r\n                                            <input type=\"text\" id=\"phone_number\" name=\"phone_number\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.phone_number\" #phone_number=\"ngModel\" required>\r\n                                           \r\n                                        </div> &nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Position</label>    \r\n\r\n                                             <select [(ngModel)]=\"form.position\" #position=\"ngModel\" id=\"position\" required\r\n                                                    name=\"position\" class=\"form-control\">\r\n                                                    <option *ngFor=\"let row of dd.position\" [value]=\"row.id\">{{ row.name }}</option>\r\n                                            </select>                   \r\n                                            \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Rank</label>                   \r\n                                                \r\n                                                <ng-select [items]=\"dd.rank\"\r\n                                                    bindLabel=\"name\"\r\n                                                    bindValue=\"id\"\r\n                                                    placeholder=\"- Select -\"\r\n                                                    [(ngModel)]=\"form.rank_id\"\r\n                                                    #rank_id=\"ngModel\"\r\n                                                    name=\"rank_id\">\r\n                                                </ng-select>                                  \r\n                                            \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Sponsor</label> \r\n                                            \r\n                                                <input type=\"text\" id=\"sponsor_id\" name=\"sponsor_id\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.sponsor_id\" #sponsor_id=\"ngModel\" required>\r\n                                         \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Upline</label> \r\n                                            \r\n                                                <input type=\"text\" id=\"parent_id\" name=\"parent_id\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.parent_id\" #parent_id=\"ngModel\" required>\r\n                                            \r\n                                        </div>&nbsp;\r\n                                       \r\n                                        \r\n                                        \r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-nama\">Status</label>\r\n                                            <select [(ngModel)]=\"form.status\" #status=\"ngModel\" id=\"status\" required\r\n                                                    name=\"status\" class=\"form-control\">\r\n                                                    <option *ngFor=\"let row of dd.status\" [value]=\"row.id\">{{ row.name }}</option>\r\n                                            </select>\r\n                                            <small *ngIf=\"f.submitted && !status.valid\" class=\"help-block text-danger\">{{ status.errors ? status.errors : 'Status harus di isi' }}</small>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                            <div class=\"card-footer\">\r\n                                <div *ngIf=\"loading\" class=\"text-warning mb-0 mt-2\"><i class=\"fa fa-circle-o-notch fa-spin\"></i> Proses Data...</div>\r\n\r\n                                <button *ngIf=\"!loading\" type=\"submit\" [disabled]=\"!f.valid\" class=\"btn btn-sm btn-success\" id=\"submit\">\r\n                                    <i class=\"fa fa-dot-circle-o\"></i> Submit</button>&nbsp;\r\n                                <button *ngIf=\"!loading\" type=\"reset\" class=\"btn btn-sm btn-danger\" (click)=\"clearForm();mapsModal.hide();\">\r\n                                    <i class=\"fa fa-ban\"></i> Cancel</button>&nbsp;\r\n                            </div>\r\n\r\n                        </div>\r\n                        </form>\r\n                    </div>\r\n\r\n\r\n\r\n\r\n\r\n                </div>\r\n            </div>\r\n    \r\n        </div>\r\n    </div>"

/***/ }),

/***/ "./src/app/views/member/member-nonactive.component.ts":
/*!************************************************************!*\
  !*** ./src/app/views/member/member-nonactive.component.ts ***!
  \************************************************************/
/*! exports provided: MemberNonactiveComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MemberNonactiveComponent", function() { return MemberNonactiveComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _services_index__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/index */ "./src/app/services/index.ts");
/* harmony import */ var _system_base_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../system/base.component */ "./src/app/views/system/base.component.ts");
var __extends = (undefined && undefined.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var MemberNonactiveComponent = /** @class */ (function (_super) {
    __extends(MemberNonactiveComponent, _super);
    function MemberNonactiveComponent(mainService, rankService, alert) {
        var _this = _super.call(this, alert) || this;
        _this.mainService = mainService;
        _this.rankService = rankService;
        _this.alert = alert;
        _this.dd = {
            status: [
                { id: 1, name: 'Active' },
                { id: 0, name: 'Nonactive' }
            ],
            gender: [
                { id: 1, name: 'Female' },
                { id: 0, name: 'Male' }
            ],
            married: [
                { id: 1, name: 'Married' },
                { id: 0, name: 'Single' }
            ],
            position: [
                { id: 1, name: 'Left' },
                { id: 2, name: 'Middle' },
                { id: 3, name: 'Right' },
            ],
            member: [],
            rank: []
        };
        _this.moduleName = 'Data Member Nonactive';
        _this.moduleForm = {
            'id_member': '',
            'username': '',
            'first_name': '',
            'last_name': '',
            'email': '',
            'password': '',
            'birthdate': '',
            'npwp_number': '',
            'is_married': '',
            'gender': '',
            'status': 1,
            'phone_number': '',
            'no_rec': '',
            'position': '',
            'parent_id': '',
            'sponsor_id': '',
            'rank_id': '',
            'created_at': '',
            'updated_at': '',
            'bitrex_cash': '',
            'bitrex_points': '',
            'pv': '',
        };
        _this.moduleFilter = {
            'code': '',
            'name': '',
            'status': 0,
        };
        _this.model = mainService;
        _this.modulePermission = 'Member.Member.';
        return _this;
    }
    /**
     * function loaddependencies untuk load data service
     */
    MemberNonactiveComponent.prototype.loadDependencies = function () {
        var _this = this;
        this.rankService.get({}).subscribe(function (res) {
            _this.dd.rank = res.data;
        }, function (err) {
            _this.alert.error('Failed to load data');
        });
    };
    /**
     * Validasi Data Form Utama
     *
     * @returns boolean hasil validasi true/false
     */
    MemberNonactiveComponent.prototype.validate = function () {
        return true;
    };
    MemberNonactiveComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            moduleId: module.i,
            template: __webpack_require__(/*! ./member-nonactive.component.html */ "./src/app/views/member/member-nonactive.component.html")
        }),
        __metadata("design:paramtypes", [_services_index__WEBPACK_IMPORTED_MODULE_1__["MemberService"],
            _services_index__WEBPACK_IMPORTED_MODULE_1__["RankService"],
            _services_index__WEBPACK_IMPORTED_MODULE_1__["AlertService"]])
    ], MemberNonactiveComponent);
    return MemberNonactiveComponent;
}(_system_base_component__WEBPACK_IMPORTED_MODULE_2__["BaseComponent"]));



/***/ }),

/***/ "./src/app/views/member/member-routing.module.ts":
/*!*******************************************************!*\
  !*** ./src/app/views/member/member-routing.module.ts ***!
  \*******************************************************/
/*! exports provided: MemberRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MemberRoutingModule", function() { return MemberRoutingModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var _member_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./member.component */ "./src/app/views/member/member.component.ts");
/* harmony import */ var _member_nonactive_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./member-nonactive.component */ "./src/app/views/member/member-nonactive.component.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};




var routes = [
    {
        path: '',
        data: {
            title: 'Admin Management'
        },
        children: [
            {
                path: 'member',
                component: _member_component__WEBPACK_IMPORTED_MODULE_2__["MemberComponent"],
                data: {
                    title: 'Member'
                }
            },
            {
                path: 'member-nonactive',
                component: _member_nonactive_component__WEBPACK_IMPORTED_MODULE_3__["MemberNonactiveComponent"],
                data: {
                    title: 'Member Nonactive'
                }
            }
        ]
    }
];
var MemberRoutingModule = /** @class */ (function () {
    function MemberRoutingModule() {
    }
    MemberRoutingModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"].forChild(routes)],
            exports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"]]
        })
    ], MemberRoutingModule);
    return MemberRoutingModule;
}());



/***/ }),

/***/ "./src/app/views/member/member.component.html":
/*!****************************************************!*\
  !*** ./src/app/views/member/member.component.html ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"animated fadeIn\">\r\n\r\n    <div class=\"row\" >\r\n        <div class=\"col-lg-12\">\r\n            <div class=\"card\">\r\n                <div class=\"card-header\">\r\n                    <i class=\"fa fa-align-justify\"></i> {{moduleName}}\r\n\r\n                    <span class=\"float-right\">\r\n                            <button *appHasPermission=\"modulePermission+'Create'\" class=\"btn btn-primary btn-sm\" (click)=\"addData();mapsModal.show()\">\r\n                                <i class=\"fa fa-plus\"></i> Add New</button>&nbsp;\r\n                        </span>\r\n                </div>\r\n\r\n                <!--div class=\"card-body\">\r\n                    <button class=\"btn btn-primary btn-sm\" (click)=\"addData()\"><i class=\"fa fa-plus\"></i> Add New</button>&nbsp;\r\n                </div-->\r\n\r\n                <!--serch-->\r\n                <div class=\"card-body\">\r\n                    <form class=\"form-horizontal\">\r\n                        <div class=\"row\">    \r\n\r\n                            <div class=\"col-sm-3\">\r\n\r\n                                <div class=\"form-group row\">\r\n                                    <!-- <label class=\"col-md-4 col-form-label\" for=\"f-perusahaan\">Member</label> -->\r\n                                    <div class=\"col-md-12\">\r\n                                        <ng-select [items]=\"dd.member\"\r\n                                            bindLabel=\"id_member\"\r\n                                            bindValue=\"id_member\"\r\n                                            placeholder=\"- Search Member ID-\"\r\n                                            [(ngModel)]=\"filter.id_member\"\r\n                                            #id_member=\"ngModel\"\r\n                                            name=\"id_member\"\r\n                                            (keyup)=\"cariID($event)\"\r\n                                        >\r\n                                        </ng-select>\r\n                                    </div>\r\n                                </div>\r\n                            </div>                       \r\n                            \r\n                            <!-- <div class=\"col-sm-5\">&nbsp;</div> -->\r\n                            <div class=\"col-sm-3\">\r\n\r\n                                <div class=\"form-group row\">\r\n                                    <!-- <label class=\"col-md-4 col-form-label\" for=\"f-perusahaan\">Member</label> -->\r\n                                    <div class=\"col-md-12\">\r\n                                           <ng-select [items]=\"dd.member\"\r\n                                            bindLabel=\"first_name\"\r\n                                            bindValue=\"id_member\"\r\n                                            placeholder=\"- Search Member Name-\"\r\n                                            [(ngModel)]=\"filter.first_name\"\r\n                                            #first_name=\"ngModel\"\r\n                                            name=\"first_name\"\r\n                                            (keyup)=\"cariData($event)\"\r\n                                        >\r\n                                        </ng-select>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n\r\n\r\n                            <div class=\"col-md-3\">\r\n                                <button type=\"button\" class=\"btn btn-sm btn-primary\" (click)=\"doSearch()\"><i class=\"fa fa-search\"></i> Filter</button>&nbsp;\r\n\r\n                                <button type=\"button\" class=\"btn btn-sm btn-primary\" (click)=\"clearSearch()\"><i class=\"fa fa-ban\"></i> UnFilter</button>&nbsp;\r\n                            </div>\r\n                        </div>\r\n                    </form>\r\n                </div>\r\n\r\n                <div class=\"card-body\">\r\n                    <div *ngIf=\"loading\" class=\"text-warning mb-0 mt-2\"><i class=\"fa fa-circle-o-notch fa-spin\"></i> Loading Data...</div>\r\n\r\n                    <table *ngIf=\"!loading\" class=\"table table-hover table-striped table-sm\">\r\n                        <thead>\r\n                            <tr>\r\n                                <th>No.</th>\r\n                                <th>ID Member</th>\r\n                                <th>Name</th>\r\n                                <th>HP</th>\r\n                                <th>Rank</th>\r\n                                <th>Status</th>\r\n                                <th>Action</th>\r\n                            </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                            <tr *ngFor=\"let row of data | paginate: { id: 'member',\r\n                            itemsPerPage: pageSize,\r\n                            currentPage: currentPage,\r\n                            totalItems: totalItems}; let i = index\">\r\n                                <td>{{ i+1 }}</td>\r\n                                <td>{{ row.id_member }}</td>\r\n                                <td>{{ row.first_name +' '+row.last_name }}</td>\r\n                                <td>{{ row.phone_number }}</td>\r\n                                <td>{{ row.rank ? row.rank.name : '' }}</td>\r\n                                <td *ngIf=\"row.status == 1\">Active</td>\r\n                                <td *ngIf=\"row.status == 0\">Nonactive</td>\r\n                                <td>\r\n                                    <button type=\"button\" class=\"btn btn-warning btn-sm\" (click)=\"editData(row);mapsModal.show()\"><i class=\"fa fa-pencil-alt\"></i></button>&nbsp;\r\n                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" (click)=\"deleteData(row)\"><i class=\"fa fa-trash\"></i></button>&nbsp;\r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>\r\n\r\n                     <div class=\"pull-right\">\r\n                        <pagination-controls id=\"member\" previousLabel=\"\" nextLabel=\"\" autoHide=\"true\" (pageChange)=\"currentPage = $event\"></pagination-controls>\r\n                    </div>\r\n\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n    <div class=\"row\" *ngIf=\"!showList\">\r\n\r\n        \r\n    </div>\r\n</div>\r\n\r\n<!-- modal -->\r\n\r\n<div bsModal #mapsModal=\"bs-modal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"dialog-auto-name\">\r\n        <div class=\"modal-dialog modal-lg\">\r\n            <div class=\"modal-content\">\r\n    \r\n                <div class=\"modal-header\">\r\n                    <h4 id=\"dialog-auto-name\" class=\"modal-title pull-left\">{{moduleName}}</h4>\r\n                    <button type=\"button\" class=\"close pull-right\" aria-label=\"Close\" (click)=\"mapsModal.hide(); clearForm()\">\r\n                        <span aria-hidden=\"true\">&times;</span>\r\n                    </button>&nbsp;\r\n                </div>\r\n    \r\n                <div class=\"modal-body\">\r\n\r\n                    <div class=\"col-sm-12\">\r\n\r\n\r\n\r\n                        <form #f=\"ngForm\" novalidate (ngSubmit)=\"saveData(f.value, f.valid)\" class=\"form-horizontal\">\r\n\r\n                        <div class=\"card\">\r\n                            <div class=\"card-header\">\r\n                                <strong>{{moduleName}}</strong> Add/Edit\r\n                            </div>\r\n                            <div class=\"card-body\">\r\n\r\n                                <div class=\"row\">\r\n                                    <div class=\"col-sm-4\">\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">First Name</label>                                 \r\n                                            <input type=\"text\" id=\"first_name\" name=\"first_name\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.first_name\" #first_name=\"ngModel\" required>\r\n                                           \r\n                                        </div>\r\n                                        &nbsp;\r\n\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Last Name</label>       \r\n                                            <input type=\"text\" id=\"last_name\" name=\"last_name\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.last_name\" #last_name=\"ngModel\" required>\r\n                                         \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Gender</label>                                \r\n                                            \r\n                                             <select [(ngModel)]=\"form.gender\" #gender=\"ngModel\" id=\"gender\" required\r\n                                                    name=\"gender\" class=\"form-control\">\r\n                                                    <option *ngFor=\"let row of dd.gender\" [value]=\"row.id\">{{ row.name }}</option>\r\n                                            </select>\r\n                                          \r\n                                        </div>&nbsp;                            \r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Birth Date</label> \r\n                                            \r\n                                            <input type=\"text\" readonly bsDatepicker [bsConfig]=\"{ dateInputFormat: 'YYYY-MM-DD' }\"  id=\"birthdate\" name=\"birthdate\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.birthdate\" #birthdate=\"ngModel\" required>\r\n                                            \r\n                                        </div> &nbsp;                      \r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Married Status</label>     \r\n                                             <select [(ngModel)]=\"form.is_married\" #is_married=\"ngModel\" id=\"is_married\" required\r\n                                                    name=\"is_married\" class=\"form-control\">\r\n                                                    <option *ngFor=\"let row of dd.married\" [value]=\"row.id\">{{ row.name }}</option>\r\n                                            </select>\r\n                                            \r\n                                        </div>\r\n\r\n                                    </div>\r\n                                    <div class=\"col-sm-4\">\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Username</label>                               \r\n                                                <input type=\"text\" id=\"username\" name=\"username\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.username\" #username=\"ngModel\" required>\r\n                                            \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Password</label>                                 \r\n                                            <input type=\"text\" id=\"password\" name=\"password\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.password\" #password=\"ngModel\" required>\r\n                                            \r\n                                        </div>&nbsp;\r\n                                         <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Npwp Number</label> \r\n                                            \r\n                                                <input type=\"text\" id=\"npwp_number\" name=\"npwp_number\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.npwp_number\" #npwp_number=\"ngModel\" required>\r\n                                           \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">No Rekening</label> \r\n                                            \r\n                                                <input type=\"text\" id=\"no_rec\" name=\"no_rec\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.no_rec\" #no_rec=\"ngModel\" required>\r\n                                           \r\n                                        </div>&nbsp;\r\n                                        \r\n\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Email</label>                               \r\n                                            <input type=\"text\" id=\"email\" name=\"email\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.email\" #email=\"ngModel\" required>\r\n                                           \r\n                                        </div>&nbsp;\r\n                                                          \r\n\r\n                                    </div>\r\n                                    <div class=\"col-sm-4\">\r\n                                          <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Phone Number</label>                                 \r\n                                            <input type=\"text\" id=\"phone_number\" name=\"phone_number\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.phone_number\" #phone_number=\"ngModel\" required>\r\n                                           \r\n                                        </div> &nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Position</label>    \r\n\r\n                                             <select [(ngModel)]=\"form.position\" #position=\"ngModel\" id=\"position\" required\r\n                                                    name=\"position\" class=\"form-control\">\r\n                                                    <option *ngFor=\"let row of dd.position\" [value]=\"row.id\">{{ row.name }}</option>\r\n                                            </select>                   \r\n                                            \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Rank</label>                   \r\n                                                \r\n                                                <ng-select [items]=\"dd.rank\"\r\n                                                    bindLabel=\"name\"\r\n                                                    bindValue=\"id\"\r\n                                                    placeholder=\"- Select -\"\r\n                                                    [(ngModel)]=\"form.rank_id\"\r\n                                                    #rank_id=\"ngModel\"\r\n                                                    name=\"rank_id\">\r\n                                                </ng-select>                                  \r\n                                            \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Sponsor</label> \r\n                                            \r\n                                                <input type=\"text\" id=\"sponsor_id\" name=\"sponsor_id\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.sponsor_id\" #sponsor_id=\"ngModel\" required>\r\n                                         \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Upline</label> \r\n                                            \r\n                                                <input type=\"text\" id=\"parent_id\" name=\"parent_id\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.parent_id\" #parent_id=\"ngModel\" required>\r\n                                            \r\n                                        </div>&nbsp;\r\n                                       \r\n                                        \r\n                                        \r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-nama\">Status</label>\r\n                                            <select [(ngModel)]=\"form.status\" #status=\"ngModel\" id=\"status\" required\r\n                                                    name=\"status\" class=\"form-control\">\r\n                                                    <option *ngFor=\"let row of dd.status\" [value]=\"row.id\">{{ row.name }}</option>\r\n                                            </select>\r\n                                            <small *ngIf=\"f.submitted && !status.valid\" class=\"help-block text-danger\">{{ status.errors ? status.errors : 'Status harus di isi' }}</small>\r\n                                        </div>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                            <div class=\"card-footer\">\r\n                                <div *ngIf=\"loading\" class=\"text-warning mb-0 mt-2\"><i class=\"fa fa-circle-o-notch fa-spin\"></i> Proses Data...</div>\r\n\r\n                                <button *ngIf=\"!loading\" type=\"submit\" [disabled]=\"!f.valid\" class=\"btn btn-sm btn-success\" id=\"submit\">\r\n                                    <i class=\"fa fa-dot-circle-o\"></i> Submit</button>&nbsp;\r\n                                <button *ngIf=\"!loading\" type=\"reset\" class=\"btn btn-sm btn-danger\" (click)=\"clearForm();mapsModal.hide();\">\r\n                                    <i class=\"fa fa-ban\"></i> Cancel</button>&nbsp;\r\n                            </div>\r\n\r\n                        </div>\r\n                        </form>\r\n                    </div>\r\n\r\n\r\n\r\n\r\n                </div>\r\n            </div>\r\n    \r\n        </div>\r\n    </div>"

/***/ }),

/***/ "./src/app/views/member/member.component.ts":
/*!**************************************************!*\
  !*** ./src/app/views/member/member.component.ts ***!
  \**************************************************/
/*! exports provided: MemberComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MemberComponent", function() { return MemberComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _services_index__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/index */ "./src/app/services/index.ts");
/* harmony import */ var _system_base_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../system/base.component */ "./src/app/views/system/base.component.ts");
/* harmony import */ var ngx_bootstrap_modal__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ngx-bootstrap/modal */ "./node_modules/ngx-bootstrap/modal/fesm5/ngx-bootstrap-modal.js");
var __extends = (undefined && undefined.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var MemberComponent = /** @class */ (function (_super) {
    __extends(MemberComponent, _super);
    function MemberComponent(mainService, rankService, alert) {
        var _this = _super.call(this, alert) || this;
        _this.mainService = mainService;
        _this.rankService = rankService;
        _this.alert = alert;
        _this.dd = {
            status: [
                { id: 1, name: 'Active' },
                { id: 0, name: 'Nonactive' }
            ],
            gender: [
                { id: 1, name: 'Female' },
                { id: 0, name: 'Male' }
            ],
            married: [
                { id: 1, name: 'Married' },
                { id: 0, name: 'Single' }
            ],
            position: [
                { id: 1, name: 'Left' },
                { id: 2, name: 'Middle' },
                { id: 3, name: 'Right' },
            ],
            member: [],
            rank: []
        };
        _this.moduleName = 'Data Member Active';
        _this.moduleForm = {
            'id_member': '',
            'username': '',
            'first_name': '',
            'last_name': '',
            'email': '',
            'password': '',
            'birthdate': '',
            'npwp_number': '',
            'is_married': '',
            'gender': '',
            'status': 1,
            'phone_number': '',
            'no_rec': '',
            'position': '',
            'parent_id': '',
            'sponsor_id': '',
            'rank_id': '',
            'created_at': '',
            'updated_at': '',
            'bitrex_cash': '',
            'bitrex_points': '',
            'pv': '',
        };
        _this.moduleFilter = {
            'code': '',
            'name': '',
            'status': 1
        };
        _this.model = mainService;
        _this.modulePermission = 'Member.Member.';
        return _this;
    }
    /**
     * function loaddependencies untuk load data service
     */
    MemberComponent.prototype.loadDependencies = function () {
        var _this = this;
        this.rankService.get({}).subscribe(function (res) {
            _this.dd.rank = res.data;
        }, function (err) {
            _this.alert.error('Failed to load data');
        });
    };
    /**
     * Validasi Data Form Utama
     *
     * @returns boolean hasil validasi true/false
     */
    MemberComponent.prototype.validate = function () {
        return true;
    };
    MemberComponent.prototype.cariData = function (q) {
        var _this = this;
        var xy = q.target.value;
        if (xy.length < 3) {
            return false;
        }
        this.mainService.get({ first_name: xy }).subscribe(function (res) {
            _this.dd.member = res.data;
        }, function (err) {
            _this.alert.error('Failed to load data');
        });
    };
    MemberComponent.prototype.cariID = function (q) {
        var _this = this;
        var xy = q.target.value;
        if (xy.length < 3) {
            return false;
        }
        this.mainService.get({ id_member: xy }).subscribe(function (res) {
            _this.dd.member = res.data;
        }, function (err) {
            _this.alert.error('Failed to load data');
        });
    };
    __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"])('f'),
        __metadata("design:type", HTMLFormElement)
    ], MemberComponent.prototype, "htmlForm", void 0);
    __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"])('mapsModal'),
        __metadata("design:type", ngx_bootstrap_modal__WEBPACK_IMPORTED_MODULE_3__["ModalDirective"])
    ], MemberComponent.prototype, "mapsModal", void 0);
    MemberComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            moduleId: module.i,
            template: __webpack_require__(/*! ./member.component.html */ "./src/app/views/member/member.component.html")
        }),
        __metadata("design:paramtypes", [_services_index__WEBPACK_IMPORTED_MODULE_1__["MemberService"],
            _services_index__WEBPACK_IMPORTED_MODULE_1__["RankService"],
            _services_index__WEBPACK_IMPORTED_MODULE_1__["AlertService"]])
    ], MemberComponent);
    return MemberComponent;
}(_system_base_component__WEBPACK_IMPORTED_MODULE_2__["BaseComponent"]));



/***/ }),

/***/ "./src/app/views/member/member.module.ts":
/*!***********************************************!*\
  !*** ./src/app/views/member/member.module.ts ***!
  \***********************************************/
/*! exports provided: MemberModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "MemberModule", function() { return MemberModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var ngx_bootstrap_datepicker__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ngx-bootstrap/datepicker */ "./node_modules/ngx-bootstrap/datepicker/fesm5/ngx-bootstrap-datepicker.js");
/* harmony import */ var ngx_bootstrap_tabs__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ngx-bootstrap/tabs */ "./node_modules/ngx-bootstrap/tabs/fesm5/ngx-bootstrap-tabs.js");
/* harmony import */ var _shared_shared_module__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../shared/shared.module */ "./src/app/shared/shared.module.ts");
/* harmony import */ var ngx_bootstrap_modal__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ngx-bootstrap/modal */ "./node_modules/ngx-bootstrap/modal/fesm5/ngx-bootstrap-modal.js");
/* harmony import */ var _member_routing_module__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./member-routing.module */ "./src/app/views/member/member-routing.module.ts");
/* harmony import */ var _services_index__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../services/index */ "./src/app/services/index.ts");
/* harmony import */ var _member_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./member.component */ "./src/app/views/member/member.component.ts");
/* harmony import */ var _member_nonactive_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./member-nonactive.component */ "./src/app/views/member/member-nonactive.component.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};









var MemberModule = /** @class */ (function () {
    function MemberModule() {
    }
    MemberModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [
                _shared_shared_module__WEBPACK_IMPORTED_MODULE_3__["SharedModule"],
                _member_routing_module__WEBPACK_IMPORTED_MODULE_5__["MemberRoutingModule"],
                ngx_bootstrap_datepicker__WEBPACK_IMPORTED_MODULE_1__["BsDatepickerModule"].forRoot(),
                ngx_bootstrap_modal__WEBPACK_IMPORTED_MODULE_4__["ModalModule"].forRoot(),
                ngx_bootstrap_tabs__WEBPACK_IMPORTED_MODULE_2__["TabsModule"].forRoot()
            ],
            declarations: [
                _member_component__WEBPACK_IMPORTED_MODULE_7__["MemberComponent"],
                _member_nonactive_component__WEBPACK_IMPORTED_MODULE_8__["MemberNonactiveComponent"],
            ],
            providers: [
                _services_index__WEBPACK_IMPORTED_MODULE_6__["MemberService"],
                _services_index__WEBPACK_IMPORTED_MODULE_6__["RankService"],
                _services_index__WEBPACK_IMPORTED_MODULE_6__["AlertService"],
            ]
        })
    ], MemberModule);
    return MemberModule;
}());



/***/ })

}]);
//# sourceMappingURL=views-member-member-module.js.map