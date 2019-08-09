(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["views-laporan-laporan-module"],{

/***/ "./src/app/views/laporan/laporan-routing.module.ts":
/*!*********************************************************!*\
  !*** ./src/app/views/laporan/laporan-routing.module.ts ***!
  \*********************************************************/
/*! exports provided: LaporanRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LaporanRoutingModule", function() { return LaporanRoutingModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var _laporan_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./laporan.component */ "./src/app/views/laporan/laporan.component.ts");
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
            title: 'Laporan'
        },
        children: [
            {
                path: 'laporan',
                component: _laporan_component__WEBPACK_IMPORTED_MODULE_2__["LaporanComponent"],
                data: {
                    title: 'Laporan'
                }
            }
        ]
    }
];
var LaporanRoutingModule = /** @class */ (function () {
    function LaporanRoutingModule() {
    }
    LaporanRoutingModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"].forChild(routes)],
            exports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"]]
        })
    ], LaporanRoutingModule);
    return LaporanRoutingModule;
}());



/***/ }),

/***/ "./src/app/views/laporan/laporan.component.html":
/*!******************************************************!*\
  !*** ./src/app/views/laporan/laporan.component.html ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<style>\r\n    #menu option, #tipe option{\r\n        font-size:14px; \r\n        padding: 5px 0px 5px 0px;\r\n    }\r\n</style>\r\n<div class=\"animated fadeIn\">\r\n\r\n    <div class=\"row\">\r\n        <div class=\"col-lg-12\">\r\n            <div class=\"card\">\r\n                <div class=\"card-header\">\r\n                    <i class=\"fa fa-align-justify\"></i> Laporan\r\n                </div>\r\n                <div class=\"card-body\">\r\n                    <div class=\"row\">\r\n                        <div class=\"col-md-4\">\r\n                            <select [(ngModel)]=\"form.menu\" #menu=\"ngModel\" id=\"menu\" name=\"menu\" class=\"form-control\"  multiple style=\"height:100%\">\r\n                                <option *ngFor=\"let c of dataMenu\" [ngValue]=\"c.name\" (click)=\"loadSubMenu(c.submenu)\">{{c.name}}</option >\r\n                            </select>\r\n                        </div>\r\n\r\n                        <div class=\"col-md-4\">\r\n                            <select [(ngModel)]=\"form.tipe\" #tipe=\"ngModel\" id=\"tipe\" name=\"tipe\" class=\"form-control\"  multiple style=\"height:100%\">\r\n                                <option *ngFor=\"let c of dataSubMenu\" [ngValue]=\"c.name\" (click)=\"loadForm(c.field)\">{{c.name}}</option >\r\n                            </select>\r\n                        </div>\r\n\r\n                        <div class=\"col-md-4\" style=\"height:300px\">\r\n                            <form #f=\"ngForm\" novalidate (ngSubmit)=\"saveData(f.value, f.valid)\" class=\"form-horizontal\">\r\n\r\n                                <div class=\"form-group row\" *ngIf=\"show.from\">\r\n                                    <label class=\"col-md-5 col-form-label\" for=\"laporan_from\">Dari</label>\r\n                                    <div class=\"col-md-7\">\r\n                                        <input type=\"text\" bsDatepicker [bsConfig]=\"{ dateInputFormat: 'YYYY-MM-DD' }\" [(ngModel)]=\"form.from\" required #laporan_from=\"ngModel\" id=\"laporan_from\" name=\"laporan_from\"\r\n                                            class=\"form-control\" placeholder=\"Enter Tanggal From..\" readonly>\r\n                                    </div>\r\n                                </div>\r\n\r\n                                <div class=\"form-group row\" *ngIf=\"show.to\">\r\n                                    <label class=\"col-md-5 col-form-label\" for=\"laporan_to\">Sampai</label>\r\n                                    <div class=\"col-md-7\">\r\n                                        <input type=\"text\" bsDatepicker [bsConfig]=\"{ dateInputFormat: 'YYYY-MM-DD' }\" [(ngModel)]=\"form.to\" required #laporan_to=\"ngModel\" id=\"laporan_to\" name=\"laporan_to\"\r\n                                            class=\"form-control\" placeholder=\"Enter Tanggal To..\" readonly>\r\n                                    </div>\r\n                                </div>\r\n\r\n\r\n                                <div class=\"form-group row\" *ngIf=\"show.nama_barang\">\r\n                                    <label class=\"col-md-5 col-form-label\" for=\"cust_txt\">Kode Barang</label>\r\n                                    <div class=\"col-md-7\">\r\n\r\n                                        <ng-select [items]=\"dataBarang\"\r\n                                            bindLabel=\"code\"\r\n                                            bindValue=\"code\"\r\n                                            placeholder=\"- Select -\"\r\n                                            [(ngModel)]=\"form.code_barang\"\r\n                                            #code_barang=\"ngModel\"\r\n                                            name=\"code_barang\">\r\n                                        </ng-select>\r\n                                    </div>\r\n                                </div>\r\n\r\n                                <div class=\"form-group row\" *ngIf=\"show.barang\">\r\n                                    <label class=\"col-md-5 col-form-label\" for=\"cust_txt\">Merk Barang</label>\r\n                                    <div class=\"col-md-7\">\r\n\r\n                                        <ng-select [items]=\"merkBarang\"\r\n                                            bindLabel=\"name\"\r\n                                            bindValue=\"id\"\r\n                                            placeholder=\"- Select -\"\r\n                                            [(ngModel)]=\"form.merk_barang\"\r\n                                            #merk_barang=\"ngModel\"\r\n                                            name=\"merk_barang\">\r\n                                        </ng-select>\r\n                                    </div>\r\n                                </div>\r\n\r\n                                <div class=\"form-group row\" *ngIf=\"show.barang\">\r\n                                    <label class=\"col-md-5 col-form-label\" for=\"cust_txt\">Type Barang</label>\r\n                                    <div class=\"col-md-7\">\r\n\r\n                                        <ng-select [items]=\"typeBarang\"\r\n                                            bindLabel=\"name\"\r\n                                            bindValue=\"id\"\r\n                                            placeholder=\"- Select -\"\r\n                                            [(ngModel)]=\"form.kategori_barang\"\r\n                                            #kategori_barang=\"ngModel\"\r\n                                            name=\"kategori_barang\">\r\n                                        </ng-select>\r\n                                    </div>\r\n                                </div>\r\n\r\n                                <div class=\"form-group row\" *ngIf=\"show.customer\">\r\n                                    <label class=\"col-md-5 col-form-label\" for=\"cust_txt\">Customer</label>\r\n                                    <div class=\"col-md-7\">\r\n                                       <ng-select [items]=\"dataCustomer\"\r\n                                       bindLabel=\"name\"\r\n                                       bindValue=\"id\"\r\n                                       placeholder=\"- Select -\"\r\n                                       [(ngModel)]=\"form.id_customer\"\r\n                                       #id_customer=\"ngModel\"\r\n                                       name=\"id_customer\">\r\n                                   </ng-select>\r\n                                    </div>\r\n                                </div>\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t<div class=\"form-group\" *ngIf=\"show.supplier\">\r\n\t\t\t\t\t\t\t\t    <app-supplier #appSupplier (onValueChange)=\"selectedSupplier($event)\" [appForm]=\"form?.supplier\"></app-supplier>\r\n\r\n                                    <!-- <label class=\"col-md-5 col-form-label\" for=\"cust_txt\">Supplier</label> -->\r\n                                    <!-- <div class=\"col-md-7\"> -->\r\n                                       <!-- <ng-select [items]=\"dataSupplier\" -->\r\n                                       <!-- bindLabel=\"name\" -->\r\n                                       <!-- bindValue=\"id\" -->\r\n                                       <!-- placeholder=\"- Select -\" -->\r\n                                       <!-- [(ngModel)]=\"form.id_supplier\" -->\r\n                                       <!-- #id_supplier=\"ngModel\" -->\r\n                                       <!-- name=\"id_supplier\"> -->\r\n                                   <!-- </ng-select> -->\r\n                                    <!-- </div> -->\r\n                                </div>\r\n\r\n                                <div class=\"form-group row\" *ngIf=\"show.submit\">\r\n                                    <div class=\"col-md-1\">\r\n\r\n                                        <input type=\"checkbox\" [(ngModel)]=\"form.export_excel\" name=\"export_excel\" id=\"export_excel\" style=\"margin-top:10px\"/>\r\n\r\n                                    </div>\r\n                                    <label class=\"col-md-11 col-form-label\" for=\"export_excel\">Export to Excel</label>\r\n                                </div>\r\n                                        \r\n                                <div class=\"card-footer\" *ngIf=\"show.submit\">\r\n                                    <button *ngIf=\"!loading\" type=\"submit\" [disabled]=\"!f.valid\" class=\"btn btn-sm btn-success\">\r\n                                        <i class=\"fa fa-dot-circle-o\"></i> Submit</button>\r\n\r\n                                    <div *ngIf=\"loading\" class=\"text-warning mb-0 mt-2\">\r\n                                        <i class=\"fa fa-circle-o-notch fa-spin\"></i> Loading Data...</div>\r\n                                </div>\r\n                                \r\n                            </form>\r\n                        </div>  \r\n                    </div>                  \r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>"

/***/ }),

/***/ "./src/app/views/laporan/laporan.component.ts":
/*!****************************************************!*\
  !*** ./src/app/views/laporan/laporan.component.ts ***!
  \****************************************************/
/*! exports provided: LaporanComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LaporanComponent", function() { return LaporanComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _services__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services */ "./src/app/services/index.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var LaporanComponent = /** @class */ (function () {
    function LaporanComponent(laporanService, alert) {
        this.laporanService = laporanService;
        this.alert = alert;
        this.loading = false;
        this.showList = true;
        this.editMode = false;
        this.show = {
            'from': false,
            'to': false,
            'barang': false,
            'pembayaran': false
        };
        this.dataCustomer = [];
        this.dataSupplier = [];
        this.dataBarang = [];
        this.typeBarang = [];
        this.merkBarang = [];
        this.dataMenu = [];
        this.dataSubMenu = [];
        this.data = [];
        this.form = {};
        this.filter = {};
    }
    LaporanComponent.prototype.ngOnInit = function () {
        this.clearForm();
        this.dataMenu = [
            {
                'name': 'Master Data',
                'submenu': [
                    { 'name': 'Pelanggan', 'field': { 'fieldFrom': true, 'fieldTo': true } },
                    { 'name': 'Barang', 'field': { 'fieldBarang': true } }
                ]
            },
            {
                'name': 'Penjualan',
                'submenu': [
                    { 'name': 'Penjualan Per Barang', 'field': { 'fieldFrom': true, 'fieldTo': true, 'fieldNamaBarang': true } },
                    { 'name': 'Penjualan Per Pelanggan', 'field': { 'fieldFrom': true, 'fieldTo': true, 'fieldCustomer': true } },
                    { 'name': 'Penjualan Per Tanggal', 'field': { 'fieldFrom': true, 'fieldTo': true } }
                ]
            },
            {
                'name': 'Pembelian',
                'submenu': [
                    { 'name': 'Pembelian Per Barang', 'field': { 'fieldFrom': true, 'fieldTo': true, 'fieldNamaBarang': true } },
                    { 'name': 'Pembelian Per Supplier', 'field': { 'fieldFrom': true, 'fieldTo': true, 'fieldSupplier': true } },
                    { 'name': 'Pembelian Per Tanggal', 'field': { 'fieldFrom': true, 'fieldTo': true } }
                ]
            },
            {
                'name': 'Profit',
                'submenu': [
                    { 'name': 'Profit Per Barang', 'field': { 'fieldFrom': true, 'fieldTo': true, 'fieldNamaBarang': true } },
                    { 'name': 'Profit Per Pelanggan', 'field': { 'fieldFrom': true, 'fieldTo': true, 'fieldCustomer': true } },
                    { 'name': 'Profit Per Tanggal', 'field': { 'fieldFrom': true, 'fieldTo': true } }
                ]
            }
        ];
    };
    LaporanComponent.prototype.saveData = function (value, valid) {
        var _this = this;
        this.loading = true;
        this.laporanService.generate('laporan', this.form)
            .subscribe(function (res) {
            _this.loading = false;
            if (res.status === 200) {
                if (_this.form.export_excel) {
                    window.location.href = res.url;
                }
                else {
                    window.open(res.url, '_blank');
                }
            }
            else {
                _this.alert.error(res.message);
            }
        }, function (err) {
            _this.loading = false;
            _this.alert.error('Generate Laporan Gagal!');
        });
    };
    LaporanComponent.prototype.clearForm = function () {
        this.form = {
            'menu': '',
            'tipe': '',
            'output': 'pdf',
            'from': '',
            'to': '',
            'nama_customer': '',
            'export_excel': 0
        };
    };
    LaporanComponent.prototype.loadSubMenu = function (submenu) {
        this.show = {
            'from': false,
            'to': false,
            'nama_barang': false,
            'barang': false,
            'customer': false,
            'supplier': false,
            'submit': false
        };
        this.dataSubMenu = submenu;
    };
    /**
    * get data from popup
    * @param q data object formDetail
    */
    LaporanComponent.prototype.selectedSupplier = function (q) {
        this.form.id_supplier = q.id;
    };
    LaporanComponent.prototype.loadForm = function (formControl) {
        this.show = {
            'from': false,
            'to': false,
            'barang': false,
            'nama_barang': false,
            'customer': false,
            'supplier': false,
            'submit': false
        };
        if (formControl.fieldFrom && typeof formControl.fieldFrom !== 'undefined') {
            this.show.from = formControl.fieldFrom;
        }
        if (formControl.fieldTo && typeof formControl.fieldTo !== 'undefined') {
            this.show.to = formControl.fieldTo;
        }
        if (formControl.fieldNamaBarang && typeof formControl.fieldNamaBarang !== 'undefined') {
            this.show.nama_barang = formControl.fieldNamaBarang;
        }
        if (formControl.fieldBarang && typeof formControl.fieldBarang !== 'undefined') {
            this.show.barang = formControl.fieldBarang;
        }
        if (formControl.fieldCustomer && typeof formControl.fieldCustomer !== 'undefined') {
            this.show.customer = formControl.fieldCustomer;
        }
        if (formControl.fieldSupplier && typeof formControl.fieldSupplier !== 'undefined') {
            this.show.supplier = formControl.fieldSupplier;
        }
        if (formControl.fieldExportExcel && typeof formControl.fieldExportExcel !== 'undefined') {
            this.show.export_excel = formControl.fieldExportExcel;
        }
        this.show.submit = true;
    };
    LaporanComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            moduleId: module.i,
            template: __webpack_require__(/*! ./laporan.component.html */ "./src/app/views/laporan/laporan.component.html")
        }),
        __metadata("design:paramtypes", [_services__WEBPACK_IMPORTED_MODULE_1__["LaporanService"],
            _services__WEBPACK_IMPORTED_MODULE_1__["AlertService"]])
    ], LaporanComponent);
    return LaporanComponent;
}());



/***/ }),

/***/ "./src/app/views/laporan/laporan.module.ts":
/*!*************************************************!*\
  !*** ./src/app/views/laporan/laporan.module.ts ***!
  \*************************************************/
/*! exports provided: LaporanModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "LaporanModule", function() { return LaporanModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var ngx_bootstrap_datepicker__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ngx-bootstrap/datepicker */ "./node_modules/ngx-bootstrap/datepicker/fesm5/ngx-bootstrap-datepicker.js");
/* harmony import */ var _shared_shared_module__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../shared/shared.module */ "./src/app/shared/shared.module.ts");
/* harmony import */ var ngx_bootstrap_modal__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ngx-bootstrap/modal */ "./node_modules/ngx-bootstrap/modal/fesm5/ngx-bootstrap-modal.js");
/* harmony import */ var _laporan_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./laporan.component */ "./src/app/views/laporan/laporan.component.ts");
/* harmony import */ var _laporan_routing_module__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./laporan-routing.module */ "./src/app/views/laporan/laporan-routing.module.ts");
/* harmony import */ var _services__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../services */ "./src/app/services/index.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};







var LaporanModule = /** @class */ (function () {
    function LaporanModule() {
    }
    LaporanModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [
                _shared_shared_module__WEBPACK_IMPORTED_MODULE_2__["SharedModule"],
                _laporan_routing_module__WEBPACK_IMPORTED_MODULE_5__["LaporanRoutingModule"],
                ngx_bootstrap_datepicker__WEBPACK_IMPORTED_MODULE_1__["BsDatepickerModule"].forRoot(),
                ngx_bootstrap_modal__WEBPACK_IMPORTED_MODULE_3__["ModalModule"].forRoot()
            ],
            declarations: [
                _laporan_component__WEBPACK_IMPORTED_MODULE_4__["LaporanComponent"]
            ],
            providers: [
                _services__WEBPACK_IMPORTED_MODULE_6__["AlertService"], _services__WEBPACK_IMPORTED_MODULE_6__["LaporanService"]
            ]
        })
    ], LaporanModule);
    return LaporanModule;
}());



/***/ })

}]);
//# sourceMappingURL=views-laporan-laporan-module.js.map