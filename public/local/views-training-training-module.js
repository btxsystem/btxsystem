(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["views-training-training-module"],{

/***/ "./src/app/views/training/training-routing.module.ts":
/*!***********************************************************!*\
  !*** ./src/app/views/training/training-routing.module.ts ***!
  \***********************************************************/
/*! exports provided: TrainingRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "TrainingRoutingModule", function() { return TrainingRoutingModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var _training_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./training.component */ "./src/app/views/training/training.component.ts");
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
            title: 'Training Management'
        },
        children: [
            {
                path: 'management',
                component: _training_component__WEBPACK_IMPORTED_MODULE_2__["TrainingComponent"],
                data: {
                    title: 'Training'
                }
            },
        ]
    }
];
var TrainingRoutingModule = /** @class */ (function () {
    function TrainingRoutingModule() {
    }
    TrainingRoutingModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"].forChild(routes)],
            exports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"]]
        })
    ], TrainingRoutingModule);
    return TrainingRoutingModule;
}());



/***/ }),

/***/ "./src/app/views/training/training.component.html":
/*!********************************************************!*\
  !*** ./src/app/views/training/training.component.html ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"animated fadeIn\">\r\n\r\n    <div class=\"row\">\r\n        <div class=\"col-lg-12\">\r\n            <div class=\"card\">\r\n                <div class=\"card-header\">\r\n                    <i class=\"fa fa-align-justify\"></i> {{moduleName}}\r\n\r\n                    <span class=\"float-right\">\r\n                            <button *appHasPermission=\"modulePermission+'Create'\" class=\"btn btn-primary btn-sm\" (click)=\"addData(); mapsModal.show()\">\r\n                                <i class=\"fa fa-plus\"></i> Add New</button>&nbsp;\r\n                        </span>\r\n                </div>\r\n\r\n                <!--div class=\"card-body\">\r\n                    <button class=\"btn btn-primary btn-sm\" (click)=\"addData()\"><i class=\"fa fa-plus\"></i> Add New</button>&nbsp;\r\n                </div-->\r\n \r\n                <!--serch-->\r\n                <div class=\"card-body\">\r\n                    <form class=\"form-horizontal\">\r\n                        <div class=\"row\">                           \r\n                            \r\n                            <!-- <div class=\"col-sm-5\">&nbsp;</div> -->\r\n                            <div class=\"col-sm-3\">\r\n\r\n                                <div class=\"form-group row\">\r\n                                    <!-- <label class=\"col-md-4 col-form-label\" for=\"f-perusahaan\">Member</label> -->\r\n                                    <div class=\"col-md-12\">\r\n                                        <ng-select [items]=\"dd.customer\"\r\n                                            bindLabel=\"first_name\"\r\n                                            bindValue=\"id\"\r\n                                            placeholder=\"- Search Customer Name-\"\r\n                                            [(ngModel)]=\"filter.first_name\"\r\n                                            #first_name=\"ngModel\"\r\n                                            name=\"first_name\"\r\n                                            (keyup)=\"cariData($event)\"\r\n                                        >\r\n                                        </ng-select>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                            \r\n\r\n                            <div class=\"col-md-3\">\r\n                                <button type=\"button\" class=\"btn btn-sm btn-primary\" (click)=\"doSearch()\"><i class=\"fa fa-search\"></i> Filter</button>&nbsp;\r\n\r\n                                <button type=\"button\" class=\"btn btn-sm btn-primary\" (click)=\"clearSearch()\"><i class=\"fa fa-ban\"></i> UnFilter</button>&nbsp;\r\n                            </div>\r\n                        </div>\r\n                    </form>\r\n                </div>\r\n\r\n                <div class=\"card-body\">\r\n                    <div *ngIf=\"loading\" class=\"text-warning mb-0 mt-2\"><i class=\"fa fa-circle-o-notch fa-spin\"></i> Loading Data...</div>\r\n\r\n                    <table *ngIf=\"!loading\" class=\"table table-hover table-striped table-sm\">\r\n                        <thead>\r\n                            <tr>\r\n                                <th>No.</th>\r\n                                <th>Location</th>\r\n                                <th>Training Star</th>\r\n                                <th>Price</th>\r\n                                <th>Capacity</th>\r\n                                <th>Status</th>\r\n                                <th>Action</th>\r\n                            </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                            <tr *ngFor=\"let row of data | paginate: { id: 'member',\r\n                            itemsPerPage: pageSize,\r\n                            currentPage: currentPage,\r\n                            totalItems: totalItems}; let i = index\">\r\n                                <td>{{ i+1 }}</td>\r\n                                <td>{{ row.location }}</td>\r\n                                <td>{{ row.start_training }}</td>\r\n                                <td>{{ row.price|number }}</td>\r\n                                <td>{{ row.capacity|number }}</td>\r\n                                <td>{{ row.note }}</td>\r\n                                <td *ngIf=\"row.open == 1\">Open</td>\r\n                                <td *ngIf=\"row.open == 0\">Close</td>\r\n                                <td>\r\n                                    <button type=\"button\" class=\"btn btn-warning btn-sm\" (click)=\"editData(row); mapsModal.show()\"><i class=\"fa fa-pencil-alt\"></i></button>&nbsp;\r\n                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" (click)=\"deleteData(row)\"><i class=\"fa fa-trash\"></i></button>&nbsp;\r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>\r\n\r\n                     <div class=\"pull-right\">\r\n                        <pagination-controls id=\"member\" previousLabel=\"\" nextLabel=\"\" autoHide=\"true\" (pageChange)=\"currentPage = $event\"></pagination-controls>\r\n                    </div>\r\n\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n    <div class=\"row\" *ngIf=\"!showList\">\r\n\r\n        \r\n    </div>\r\n</div>\r\n\r\n\r\n<div bsModal #mapsModal=\"bs-modal\" class=\"modal fade\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"dialog-auto-name\">\r\n        <div class=\"modal-dialog modal-md\">\r\n            <div class=\"modal-content\">\r\n    \r\n                <div class=\"modal-header\">\r\n                    <h4 id=\"dialog-auto-name\" class=\"modal-title pull-left\">{{moduleName}}</h4>\r\n                    <button type=\"button\" class=\"close pull-right\" aria-label=\"Close\" (click)=\"mapsModal.hide(); clearForm()\">\r\n                        <span aria-hidden=\"true\">&times;</span>\r\n                    </button>&nbsp;\r\n                </div>\r\n    \r\n                <div class=\"modal-body\">\r\n\r\n                      <div class=\"col-sm-12\">\r\n\r\n\r\n\r\n                        <form #f=\"ngForm\" novalidate (ngSubmit)=\"saveData(f.value, f.valid)\" class=\"form-horizontal\">\r\n\r\n                        <div class=\"card\">\r\n                            <div class=\"card-header\">\r\n                                <strong>{{moduleName}}</strong> Add/Edit\r\n                            </div>\r\n                            <div class=\"card-body\">\r\n\r\n                                <div class=\"row\">\r\n                                    <div class=\"col-sm-12\">\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Location</label>                                 \r\n                                            <input type=\"text\" id=\"location\" name=\"location\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.location\" #location=\"ngModel\" required>\r\n                                           \r\n                                        </div>\r\n                                        &nbsp;\r\n\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Training Start</label>       \r\n                                            <input type=\"text\" bsDatepicker [bsConfig]=\"{ dateInputFormat: 'YYYY-MM-DD' }\" readonly id=\"start_training\" name=\"start_training\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.start_training\" #start_training=\"ngModel\" required>\r\n                                         \r\n                                        </div>&nbsp;\r\n                                        <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Price</label>       \r\n                                            <input type=\"text\" appEsPriceFormat id=\"price\" name=\"price\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.price\" #price=\"ngModel\" required>\r\n                                         \r\n                                        </div>&nbsp;\r\n\r\n                                      \r\n                                         <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Capacity</label>       \r\n                                            <input type=\"text\" id=\"capacity\" name=\"capacity\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.capacity\" #capacity=\"ngModel\" required>\r\n                                         \r\n                                        </div>&nbsp;\r\n\r\n                                         <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Note</label>       \r\n                                            <textarea type=\"text\" id=\"note\" name=\"note\" class=\"form-control\" placeholder=\"\" [(ngModel)]=\"form.note\" #note=\"ngModel\" > </textarea>\r\n                                         \r\n                                        </div>&nbsp;\r\n                                         <div class=\"form-group\">\r\n                                            <label for=\"nf-name\">Status</label>       \r\n                                            <select [(ngModel)]=\"form.open\" #open=\"ngModel\" id=\"open\" required\r\n                                                    name=\"open\" class=\"form-control\">\r\n                                                    <option *ngFor=\"let row of dd.status\" [value]=\"row.id\">{{ row.name }}</option>\r\n                                            </select>\r\n                                         \r\n                                        </div>&nbsp;                          \r\n                                        \r\n\r\n                                    </div>\r\n                                   \r\n                                </div>\r\n                            </div>\r\n                            <div class=\"card-footer\">\r\n                                <div *ngIf=\"loading\" class=\"text-warning mb-0 mt-2\"><i class=\"fa fa-circle-o-notch fa-spin\"></i> Proses Data...</div>\r\n\r\n                                <button *ngIf=\"!loading\" type=\"submit\" [disabled]=\"!f.valid\" class=\"btn btn-sm btn-success\" id=\"submit\">\r\n                                    <i class=\"fa fa-dot-circle-o\"></i> Submit</button>&nbsp;\r\n                                <button *ngIf=\"!loading\" type=\"reset\" class=\"btn btn-sm btn-danger\" (click)=\"clearForm();mapsModal.hide();\">\r\n                                    <i class=\"fa fa-ban\"></i> Cancel</button>&nbsp;\r\n                            </div>\r\n\r\n                        </div>\r\n                        </form>\r\n                    </div>\r\n\r\n\r\n\r\n                </div>\r\n            </div>\r\n    \r\n        </div>\r\n    </div>\r\n"

/***/ }),

/***/ "./src/app/views/training/training.component.ts":
/*!******************************************************!*\
  !*** ./src/app/views/training/training.component.ts ***!
  \******************************************************/
/*! exports provided: TrainingComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "TrainingComponent", function() { return TrainingComponent; });
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




var TrainingComponent = /** @class */ (function (_super) {
    __extends(TrainingComponent, _super);
    function TrainingComponent(mainService, rankService, alert) {
        var _this = _super.call(this, alert) || this;
        _this.mainService = mainService;
        _this.rankService = rankService;
        _this.alert = alert;
        _this.dd = {
            status: [
                { id: 1, name: 'Open' },
                { id: 0, name: 'Close' }
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
            customer: [],
            rank: []
        };
        _this.moduleName = 'Data Training';
        _this.moduleForm = {
            'location': '',
            'start_training': '',
            'price': '',
            'email': '',
            'password': '',
            'open': 1
        };
        _this.moduleFilter = {
            'location': '',
            'start_training': '',
            'open': ''
        };
        _this.model = mainService;
        _this.modulePermission = 'Training.Management.';
        return _this;
    }
    /**
     * function loaddependencies untuk load data service
     */
    TrainingComponent.prototype.loadDependencies = function () {
    };
    /**
     * Validasi Data Form Utama
     *
     * @returns boolean hasil validasi true/false
     */
    TrainingComponent.prototype.validate = function () {
        return true;
    };
    TrainingComponent.prototype.modalHide = function () {
        this.mapsModal.hide();
    };
    ;
    TrainingComponent.prototype.cariData = function (q) {
        var _this = this;
        var xy = q.target.value;
        if (xy.length < 3) {
            return false;
        }
        this.mainService.get({ first_name: xy }).subscribe(function (res) {
            _this.dd.customer = res.data;
        }, function (err) {
            _this.alert.error('Failed to load data');
        });
    };
    __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"])('f'),
        __metadata("design:type", HTMLFormElement)
    ], TrainingComponent.prototype, "htmlForm", void 0);
    __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"])('mapsModal'),
        __metadata("design:type", ngx_bootstrap_modal__WEBPACK_IMPORTED_MODULE_3__["ModalDirective"])
    ], TrainingComponent.prototype, "mapsModal", void 0);
    TrainingComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            moduleId: module.i,
            template: __webpack_require__(/*! ./training.component.html */ "./src/app/views/training/training.component.html")
        }),
        __metadata("design:paramtypes", [_services_index__WEBPACK_IMPORTED_MODULE_1__["TrainingService"],
            _services_index__WEBPACK_IMPORTED_MODULE_1__["RankService"],
            _services_index__WEBPACK_IMPORTED_MODULE_1__["AlertService"]])
    ], TrainingComponent);
    return TrainingComponent;
}(_system_base_component__WEBPACK_IMPORTED_MODULE_2__["BaseComponent"]));



/***/ }),

/***/ "./src/app/views/training/training.module.ts":
/*!***************************************************!*\
  !*** ./src/app/views/training/training.module.ts ***!
  \***************************************************/
/*! exports provided: TrainingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "TrainingModule", function() { return TrainingModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var ngx_bootstrap_datepicker__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ngx-bootstrap/datepicker */ "./node_modules/ngx-bootstrap/datepicker/fesm5/ngx-bootstrap-datepicker.js");
/* harmony import */ var ngx_bootstrap_tabs__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ngx-bootstrap/tabs */ "./node_modules/ngx-bootstrap/tabs/fesm5/ngx-bootstrap-tabs.js");
/* harmony import */ var _shared_shared_module__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../shared/shared.module */ "./src/app/shared/shared.module.ts");
/* harmony import */ var ngx_bootstrap_modal__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ngx-bootstrap/modal */ "./node_modules/ngx-bootstrap/modal/fesm5/ngx-bootstrap-modal.js");
/* harmony import */ var _training_routing_module__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./training-routing.module */ "./src/app/views/training/training-routing.module.ts");
/* harmony import */ var _services_index__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../services/index */ "./src/app/services/index.ts");
/* harmony import */ var _training_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./training.component */ "./src/app/views/training/training.component.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};








var TrainingModule = /** @class */ (function () {
    function TrainingModule() {
    }
    TrainingModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [
                _shared_shared_module__WEBPACK_IMPORTED_MODULE_3__["SharedModule"],
                _training_routing_module__WEBPACK_IMPORTED_MODULE_5__["TrainingRoutingModule"],
                ngx_bootstrap_datepicker__WEBPACK_IMPORTED_MODULE_1__["BsDatepickerModule"].forRoot(),
                ngx_bootstrap_modal__WEBPACK_IMPORTED_MODULE_4__["ModalModule"].forRoot(),
                ngx_bootstrap_tabs__WEBPACK_IMPORTED_MODULE_2__["TabsModule"].forRoot()
            ],
            declarations: [
                _training_component__WEBPACK_IMPORTED_MODULE_7__["TrainingComponent"],
            ],
            providers: [
                _services_index__WEBPACK_IMPORTED_MODULE_6__["MemberService"],
                _services_index__WEBPACK_IMPORTED_MODULE_6__["CustomerService"],
                _services_index__WEBPACK_IMPORTED_MODULE_6__["TrainingService"],
                _services_index__WEBPACK_IMPORTED_MODULE_6__["RankService"],
                _services_index__WEBPACK_IMPORTED_MODULE_6__["AlertService"],
            ]
        })
    ], TrainingModule);
    return TrainingModule;
}());



/***/ })

}]);
//# sourceMappingURL=views-training-training-module.js.map