(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["views-system-system-module"],{

/***/ "./node_modules/angular-file-uploader/fesm5/angular-file-uploader.js":
/*!***************************************************************************!*\
  !*** ./node_modules/angular-file-uploader/fesm5/angular-file-uploader.js ***!
  \***************************************************************************/
/*! exports provided: AngularFileUploaderService, AngularFileUploaderComponent, AngularFileUploaderModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AngularFileUploaderService", function() { return AngularFileUploaderService; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AngularFileUploaderComponent", function() { return AngularFileUploaderComponent; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AngularFileUploaderModule", function() { return AngularFileUploaderModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/fesm5/common.js");




/**
 * @fileoverview added by tsickle
 * @suppress {checkTypes} checked by tsc
 */
var AngularFileUploaderService = /** @class */ (function () {
    function AngularFileUploaderService() {
    }
    AngularFileUploaderService.decorators = [
        { type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Injectable"], args: [{
                    providedIn: 'root'
                },] },
    ];
    /** @nocollapse */
    AngularFileUploaderService.ctorParameters = function () { return []; };
    /** @nocollapse */ AngularFileUploaderService.ngInjectableDef = Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["defineInjectable"])({ factory: function AngularFileUploaderService_Factory() { return new AngularFileUploaderService(); }, token: AngularFileUploaderService, providedIn: "root" });
    return AngularFileUploaderService;
}());

/**
 * @fileoverview added by tsickle
 * @suppress {checkTypes} checked by tsc
 */
var AngularFileUploaderComponent = /** @class */ (function () {
    function AngularFileUploaderComponent() {
        //console.log("id: ",this.id);
        //console.log("idDate: ",this.idDate);
        //console.log(Math.random());
        this.config = {};
        this.resetUpload = this.config["resetUpload"];
        this.ApiResponse = new _angular_core__WEBPACK_IMPORTED_MODULE_0__["EventEmitter"]();
        this.idDate = +new Date();
        this.reg = /(?:\.([^.]+))?$/;
        this.selectedFiles = [];
        this.notAllowedList = [];
        this.Caption = [];
        this.singleFile = true;
        this.progressBarShow = false;
        this.uploadBtn = false;
        this.uploadMsg = false;
        this.afterUpload = false;
        this.uploadClick = true;
    }
    /**
     * @param {?} rst
     * @return {?}
     */
    AngularFileUploaderComponent.prototype.ngOnChanges = /**
     * @param {?} rst
     * @return {?}
     */
    function (rst) {
        if (rst["config"]) {
            this.theme = this.config["theme"] || "";
            this.id =
                this.config["id"] ||
                    parseInt((this.idDate / 10000).toString().split(".")[1]) +
                        Math.floor(Math.random() * 20) * 10000;
            this.hideProgressBar = this.config["hideProgressBar"] || false;
            this.hideResetBtn = this.config["hideResetBtn"] || false;
            this.hideSelectBtn = this.config["hideSelectBtn"] || false;
            this.uploadBtnText = this.config["uploadBtnText"] || "Upload";
            this.maxSize = this.config["maxSize"] || 20;
            this.uploadAPI = this.config["uploadAPI"]["url"];
            this.formatsAllowed =
                this.config["formatsAllowed"] || ".jpg,.png,.pdf,.docx,.txt,.gif,.jpeg";
            this.multiple = this.config["multiple"] || false;
            this.headers = this.config["uploadAPI"]["headers"] || {};
            this.attachPinText =
                this.config["attachPinText"] || "Attach supporting documents..";
            //console.log("config: ", this.config);
            //console.log(this.config["maxSize"]);
            //console.log(this.headers);
            //console.log("rst: ", rst);
        }
        if (rst["resetUpload"]) {
            if (rst["resetUpload"].currentValue === true) {
                this.resetFileUpload();
            }
        }
    };
    /**
     * @return {?}
     */
    AngularFileUploaderComponent.prototype.ngOnInit = /**
     * @return {?}
     */
    function () {
        //console.log("Id: ", this.id);
        this.resetUpload = false;
    };
    /**
     * @return {?}
     */
    AngularFileUploaderComponent.prototype.resetFileUpload = /**
     * @return {?}
     */
    function () {
        this.selectedFiles = [];
        this.Caption = [];
        this.notAllowedList = [];
        this.uploadMsg = false;
        this.uploadBtn = false;
    };
    /**
     * @param {?} event
     * @return {?}
     */
    AngularFileUploaderComponent.prototype.onChange = /**
     * @param {?} event
     * @return {?}
     */
    function (event) {
        //console.log(this.maxSize + this.formatsAllowed + this.multiple);
        this.notAllowedList = [];
        //console.log("onchange hit");
        if (this.afterUpload || !this.multiple) {
            this.selectedFiles = [];
            this.Caption = [];
            this.afterUpload = false;
        }
        //FORMATS ALLOWED LIST
        //console.log("FORMATS ALLOWED LIST= "+this.formatsAllowed);
        //NO OF FORMATS ALLOWED
        var /** @type {?} */ formatsCount;
        formatsCount = this.formatsAllowed.match(new RegExp("\\.", "g"));
        formatsCount = formatsCount.length;
        //console.log("NO OF FORMATS ALLOWED= "+formatsCount);
        //console.log("-------------------------------");
        //ITERATE SELECTED FILES
        var /** @type {?} */ file;
        if (event.type == "drop") {
            file = event.dataTransfer.files;
            //console.log("type: drop");
        }
        else {
            file = event.target.files || event.srcElement.files;
            //console.log("type: change");
        }
        //console.log(file);
        var /** @type {?} */ currentFileExt;
        var /** @type {?} */ ext;
        var /** @type {?} */ frmtAllowed;
        for (var /** @type {?} */ i = 0; i < file.length; i++) {
            //CHECK FORMAT
            //CURRENT FILE EXTENSION
            currentFileExt = this.reg.exec(file[i].name);
            currentFileExt = currentFileExt[1];
            //console.log(file[i].name);
            frmtAllowed = false;
            //FORMAT ALLOWED LIST ITERATE
            for (var /** @type {?} */ j = formatsCount; j > 0; j--) {
                ext = this.formatsAllowed.split(".")[j];
                //console.log("FORMAT LIST ("+j+")= "+ext.split(",")[0]);
                if (j == formatsCount) {
                    ext = this.formatsAllowed.split(".")[j] + ",";
                } //check format
                if (currentFileExt.toLowerCase() == ext.split(",")[0]) {
                    frmtAllowed = true;
                }
            }
            if (frmtAllowed) {
                //console.log("FORMAT ALLOWED");
                //CHECK SIZE
                if (file[i].size > this.maxSize * 1024000) {
                    //console.log("SIZE NOT ALLOWED ("+file[i].size+")");
                    this.notAllowedList.push({
                        fileName: file[i].name,
                        fileSize: this.convertSize(file[i].size),
                        errorMsg: "Invalid size"
                    });
                    continue;
                }
                else {
                    //format allowed and size allowed then add file to selectedFile array
                    this.selectedFiles.push(file[i]);
                }
            }
            else {
                //console.log("FORMAT NOT ALLOWED");
                this.notAllowedList.push({
                    fileName: file[i].name,
                    fileSize: this.convertSize(file[i].size),
                    errorMsg: "Invalid format"
                });
                continue;
            }
        }
        if (this.selectedFiles.length !== 0) {
            this.uploadBtn = true;
            if (this.theme == "attachPin")
                this.uploadFiles();
        }
        else {
            this.uploadBtn = false;
        }
        this.uploadMsg = false;
        this.uploadClick = true;
        this.percentComplete = 0;
        event.target.value = null;
    };
    /**
     * @return {?}
     */
    AngularFileUploaderComponent.prototype.uploadFiles = /**
     * @return {?}
     */
    function () {
        var _this = this;
        //console.log(this.selectedFiles);
        var /** @type {?} */ i;
        this.progressBarShow = true;
        this.uploadClick = false;
        this.notAllowedList = [];
        var /** @type {?} */ isError = false;
        var /** @type {?} */ xhr = new XMLHttpRequest();
        var /** @type {?} */ formData = new FormData();
        for (i = 0; i < this.selectedFiles.length; i++) {
            if (this.Caption[i] == undefined)
                this.Caption[i] = "file";
            //Add DATA TO BE SENT
            formData.append(this.Caption[i], this.selectedFiles[i] /*, this.selectedFiles[i].name*/);
            //console.log(this.selectedFiles[i]+"{"+this.Caption[i]+" (Caption)}");
        }
        if (i > 1) {
            this.singleFile = false;
        }
        else {
            this.singleFile = true;
        }
        xhr.onreadystatechange = function (evnt) {
            //console.log("onready");
            if (xhr.readyState === 4) {
                if (xhr.status !== 200) {
                    isError = true;
                    _this.progressBarShow = false;
                    _this.uploadBtn = false;
                    _this.uploadMsg = true;
                    _this.afterUpload = true;
                    _this.uploadMsgText = "Upload Failed !";
                    _this.uploadMsgClass = "text-danger lead";
                    //console.log(this.uploadMsgText);
                    //console.log(evnt);
                }
                _this.ApiResponse.emit(xhr);
            }
        };
        xhr.upload.onprogress = function (evnt) {
            _this.uploadBtn = false; // button should be disabled by process uploading
            if (evnt.lengthComputable) {
                _this.percentComplete = Math.round((evnt.loaded / evnt.total) * 100);
            }
            //console.log("Progress..."/*+this.percentComplete+" %"*/);
        };
        xhr.onload = function (evnt) {
            //console.log("onload");
            //console.log(evnt);
            //console.log("onload");
            //console.log(evnt);
            _this.progressBarShow = false;
            _this.uploadBtn = false;
            _this.uploadMsg = true;
            _this.afterUpload = true;
            if (!isError) {
                _this.uploadMsgText = "Successfully Uploaded !";
                _this.uploadMsgClass = "text-success lead";
                //console.log(this.uploadMsgText + " " + this.selectedFiles.length + " file");
            }
        };
        xhr.onerror = function (evnt) {
            //console.log("onerror");
            //console.log(evnt);
        };
        xhr.open("POST", this.uploadAPI, true);
        try {
            for (var _a = Object(tslib__WEBPACK_IMPORTED_MODULE_1__["__values"])(Object.keys(this.headers)), _b = _a.next(); !_b.done; _b = _a.next()) {
                var key = _b.value;
                // Object.keys will give an Array of keys
                xhr.setRequestHeader(key, this.headers[key]);
            }
        }
        catch (e_1_1) { e_1 = { error: e_1_1 }; }
        finally {
            try {
                if (_b && !_b.done && (_c = _a.return)) _c.call(_a);
            }
            finally { if (e_1) throw e_1.error; }
        }
        //let token = sessionStorage.getItem("token");
        //xhr.setRequestHeader("Content-Type", "text/plain;charset=UTF-8");
        //xhr.setRequestHeader('Authorization', `Bearer ${token}`);
        xhr.send(formData);
        var e_1, _c;
    };
    /**
     * @param {?} i
     * @param {?} sf_na
     * @return {?}
     */
    AngularFileUploaderComponent.prototype.removeFile = /**
     * @param {?} i
     * @param {?} sf_na
     * @return {?}
     */
    function (i, sf_na) {
        //console.log("remove file clicked " + i)
        if (sf_na == "sf") {
            this.selectedFiles.splice(i, 1);
            this.Caption.splice(i, 1);
        }
        else {
            this.notAllowedList.splice(i, 1);
        }
        if (this.selectedFiles.length == 0) {
            this.uploadBtn = false;
        }
    };
    /**
     * @param {?} fileSize
     * @return {?}
     */
    AngularFileUploaderComponent.prototype.convertSize = /**
     * @param {?} fileSize
     * @return {?}
     */
    function (fileSize) {
        //console.log(fileSize + " - "+ str);
        return fileSize < 1024000
            ? (fileSize / 1024).toFixed(2) + " KB"
            : (fileSize / 1024000).toFixed(2) + " MB";
    };
    /**
     * @return {?}
     */
    AngularFileUploaderComponent.prototype.attachpinOnclick = /**
     * @return {?}
     */
    function () {
        /** @type {?} */ ((
        //console.log("ID: ", this.id);
        document.getElementById("sel" + this.id))).click();
        //$("#"+"sel"+this.id).click();
    };
    /**
     * @param {?} event
     * @return {?}
     */
    AngularFileUploaderComponent.prototype.drop = /**
     * @param {?} event
     * @return {?}
     */
    function (event) {
        event.stopPropagation();
        event.preventDefault();
        //console.log("drop: ", event);
        //console.log("drop: ", event.dataTransfer.files);
        this.onChange(event);
    };
    /**
     * @param {?} event
     * @return {?}
     */
    AngularFileUploaderComponent.prototype.allowDrop = /**
     * @param {?} event
     * @return {?}
     */
    function (event) {
        event.stopPropagation();
        event.preventDefault();
        event.dataTransfer.dropEffect = "copy";
        //console.log("allowDrop: ",event)
    };
    AngularFileUploaderComponent.decorators = [
        { type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"], args: [{
                    selector: "angular-file-uploader",
                    template: "<div class=\"container\" *ngIf=\"(theme !== 'attachPin')\" id=\"default\">\n\n    <!-- Drag n Drop theme Starts -->\n    <div *ngIf=\"theme == 'dragNDrop'\" id=\"dragNDrop\" [ngClass]=\"(hideSelectBtn && hideResetBtn) ? null : 'dragNDropBtmPad'\" class=\"dragNDrop\">\n        <div style=\"position:relative;\">\n            <div id=\"div1\" class=\"div1 afu-dragndrop-box\" (drop)=\"drop($event)\" (dragover)=\"allowDrop($event)\">\n                <p class=\"afu-dragndrop-text\">Drag N Drop</p>\n            </div>\n            <!-- <span class='label label-info' id=\"upload-file-info{{id}}\">{{selectedFiles[0]?.name}}</span> -->\n        </div>\n    </div>\n    <!-- Drag n Drop theme Ends -->\n\n    <label for=\"sel{{id}}\" class=\"btn btn-primary btn-sm afu-select-btn\" *ngIf=\"!hideSelectBtn\">Select File<span *ngIf=\"multiple\">s</span></label>\n    <input type=\"file\" id=\"sel{{id}}\" style=\"display: none\" *ngIf=\"!hideSelectBtn\" (change)=\"onChange($event)\" title=\"Select file\"\n        name=\"files[]\" [accept]=formatsAllowed [attr.multiple]=\"multiple ? '' : null\" />\n    <button class=\"btn btn-info btn-sm resetBtn afu-reset-btn\" (click)=\"resetFileUpload()\" *ngIf=\"!hideResetBtn\">Reset</button>\n    <br *ngIf=\"!hideSelectBtn\">\n    <p class=\"constraints-info afu-constraints-info\">({{formatsAllowed}}) Size limit- {{(convertSize(maxSize *1024000))}}</p>\n    <!--Selected file list-->\n    <div class=\"row\" *ngFor=\"let sf of selectedFiles;let i=index\" class=\"afu-valid-file\">\n        <p class=\"col-xs-3 textOverflow\"><span class=\"text-primary\">{{sf.name}}</span></p>\n        <p class=\"col-xs-3 padMarg sizeC\"><strong>({{convertSize(sf.size)}})</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>\n        <!--  <input class=\"col-xs-3 progress caption\"  type=\"text\"  placeholder=\"Caption..\"  [(ngModel)]=\"Caption[i]\"  *ngIf=\"uploadClick\"/> -->\n        <div class=\"progress col-xs-3 padMarg afu-progress-bar\" *ngIf=\"singleFile && progressBarShow && !hideProgressBar\">\n            <span class=\"progress-bar progress-bar-success\" role=\"progressbar\" [ngStyle]=\"{'width':percentComplete+'%'}\">{{percentComplete}}%</span>\n        </div>\n        <a class=\"col-xs-1\" role=\"button\" (click)=\"removeFile(i,'sf')\" *ngIf=\"uploadClick\"><i class=\"fa fa-times\"></i></a>\n    </div>\n    <!--Invalid file list-->\n    <div class=\"row text-danger\" *ngFor=\"let na of notAllowedList;let j=index\" class=\"afu-invalid-file\">\n        <p class=\"col-xs-3 textOverflow\"><span>{{na['fileName']}}</span></p>\n        <p class=\"col-xs-3 padMarg sizeC\"><strong>({{na['fileSize']}})</strong></p>\n        <p class=\"col-xs-3 \">{{na['errorMsg']}}</p>\n        <a class=\"col-xs-1 delFileIcon\" role=\"button\" (click)=\"removeFile(j,'na')\" *ngIf=\"uploadClick\">&nbsp;<i class=\"fa fa-times\"></i></a>\n    </div>\n\n    <div class=\"afu-upload-status\"><p *ngIf=\"uploadMsg\" class=\"{{uploadMsgClass}}\">{{uploadMsgText}}<p></div>\n    <div *ngIf=\"!singleFile && progressBarShow && !hideProgressBar\">\n        <div class=\"progress col-xs-4 padMarg afu-progress-bar\">\n            <span class=\"progress-bar progress-bar-success\" role=\"progressbar\" [ngStyle]=\"{'width':percentComplete+'%'}\">{{percentComplete}}%</span>\n        </div>\n        <br>\n        <br>\n    </div>\n    <button class=\"btn btn-success afu-upload-btn\" type=\"button\" (click)=\"uploadFiles()\" [disabled]=!uploadBtn>{{uploadBtnText}}</button>\n    <br>\n</div>\n\n<!--/////////////////////////// ATTACH PIN THEME  //////////////////////////////////////////////////////////-->\n<div *ngIf=\"theme == 'attachPin'\" id=\"attachPin\">\n    <div style=\"position:relative;padding-left:6px\">\n        <a class='btn up_btn afu-attach-pin' (click)=\"attachpinOnclick()\">\n            {{attachPinText}}\n            <i class=\"fa fa-paperclip\" aria-hidden=\"true\"></i>\n            <!-- <p style=\"margin-top:10px\">({{formatsAllowed}}) Size limit- {{(convertSize(maxSize * 1024000))}}</p> -->\n            <input type=\"file\" id=\"sel{{id}}\" (change)=\"onChange($event)\" style=\"display: none\" title=\"Select file\" name=\"files[]\" [accept]=formatsAllowed\n                [attr.multiple]=\"multiple ? '' : null\" />\n            <br>\n        </a>\n        &nbsp;\n        <span class='label label-info' id=\"upload-file-info{{id}}\">{{selectedFiles[0]?.name}}</span>\n    </div>\n</div>\n\n<!--/////////////////////////// DRAG N DROP THEME  //////////////////////////////////////////////////////////-->\n<!-- <div *ngIf=\"theme == 'dragNDrop'\" id=\"dragNDrop\">\n  <div style=\"position:relative;padding-left:6px\">\n    <div id=\"div1\" (drop)=\"drop($event)\" (dragover)=\"allowDrop($event)\">\n      <p>Drag N Drop</p>\n    </div>\n    <span class='label label-info' id=\"upload-file-info{{id}}\">{{selectedFiles[0]?.name}}</span>\n  </div>\n</div> -->",
                    styles: [".constraints-info{margin-top:10px;font-style:italic}.padMarg{padding:0;margin-bottom:0}.caption{margin-right:5px}.textOverflow{white-space:nowrap;padding-right:0;overflow:hidden;text-overflow:ellipsis}.up_btn{color:#000;background-color:transparent;border:2px solid #5c5b5b;border-radius:22px}.delFileIcon{text-decoration:none;color:#ce0909}.dragNDrop .div1{display:border-box;border:2px dashed #5c5b5b;height:6rem;width:20rem}.dragNDrop .div1>p{text-align:center;font-weight:700;color:#5c5b5b;margin-top:1.4em}.dragNDropBtmPad{padding-bottom:2rem}.afu-upload-status{padding:0;margin:0}@media screen and (max-width:620px){.caption{padding:0}}@media screen and (max-width:510px){.sizeC{width:25%}}@media screen and (max-width:260px){.caption,.sizeC{font-size:10px}}.resetBtn{margin-left:3px}"]
                },] },
    ];
    /** @nocollapse */
    AngularFileUploaderComponent.ctorParameters = function () { return []; };
    AngularFileUploaderComponent.propDecorators = {
        config: [{ type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"] }],
        resetUpload: [{ type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"] }],
        ApiResponse: [{ type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Output"] }]
    };
    return AngularFileUploaderComponent;
}());
/* interface CONFIG {
  uploadAPI: string;
  multiple?: boolean;
  formatsAllowed?: string;
  maxSize?: number;
  id?: number;
  resetUpload?: boolean;
  theme?: string;
  hideProgressBar?: boolean;
 }
 */

/**
 * @fileoverview added by tsickle
 * @suppress {checkTypes} checked by tsc
 */
var AngularFileUploaderModule = /** @class */ (function () {
    function AngularFileUploaderModule() {
    }
    AngularFileUploaderModule.decorators = [
        { type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"], args: [{
                    imports: [
                        _angular_common__WEBPACK_IMPORTED_MODULE_2__["CommonModule"]
                    ],
                    declarations: [AngularFileUploaderComponent],
                    exports: [AngularFileUploaderComponent]
                },] },
    ];
    return AngularFileUploaderModule;
}());

/**
 * @fileoverview added by tsickle
 * @suppress {checkTypes} checked by tsc
 */

/**
 * @fileoverview added by tsickle
 * @suppress {checkTypes} checked by tsc
 */



//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYW5ndWxhci1maWxlLXVwbG9hZGVyLmpzLm1hcCIsInNvdXJjZXMiOlsibmc6Ly9hbmd1bGFyLWZpbGUtdXBsb2FkZXIvbGliL2FuZ3VsYXItZmlsZS11cGxvYWRlci5zZXJ2aWNlLnRzIiwibmc6Ly9hbmd1bGFyLWZpbGUtdXBsb2FkZXIvbGliL2FuZ3VsYXItZmlsZS11cGxvYWRlci5jb21wb25lbnQudHMiLCJuZzovL2FuZ3VsYXItZmlsZS11cGxvYWRlci9saWIvYW5ndWxhci1maWxlLXVwbG9hZGVyLm1vZHVsZS50cyJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgeyBJbmplY3RhYmxlIH0gZnJvbSAnQGFuZ3VsYXIvY29yZSc7XG5cbkBJbmplY3RhYmxlKHtcbiAgcHJvdmlkZWRJbjogJ3Jvb3QnXG59KVxuZXhwb3J0IGNsYXNzIEFuZ3VsYXJGaWxlVXBsb2FkZXJTZXJ2aWNlIHtcblxuICBjb25zdHJ1Y3RvcigpIHsgfVxufVxuIiwiaW1wb3J0IHsgQ29tcG9uZW50LCBPbkluaXQsIElucHV0LCBPdXRwdXQsIEV2ZW50RW1pdHRlciwgT25DaGFuZ2VzLCBTaW1wbGVDaGFuZ2VzLCBJbmplY3QsIFZpZXdFbmNhcHN1bGF0aW9uIH0gZnJvbSAnQGFuZ3VsYXIvY29yZSc7XG5AQ29tcG9uZW50KHtcbiAgc2VsZWN0b3I6IFwiYW5ndWxhci1maWxlLXVwbG9hZGVyXCIsXG4gIHRlbXBsYXRlOiBgPGRpdiBjbGFzcz1cImNvbnRhaW5lclwiICpuZ0lmPVwiKHRoZW1lICE9PSAnYXR0YWNoUGluJylcIiBpZD1cImRlZmF1bHRcIj5cclxuXHJcbiAgICA8IS0tIERyYWcgbiBEcm9wIHRoZW1lIFN0YXJ0cyAtLT5cclxuICAgIDxkaXYgKm5nSWY9XCJ0aGVtZSA9PSAnZHJhZ05Ecm9wJ1wiIGlkPVwiZHJhZ05Ecm9wXCIgW25nQ2xhc3NdPVwiKGhpZGVTZWxlY3RCdG4gJiYgaGlkZVJlc2V0QnRuKSA/IG51bGwgOiAnZHJhZ05Ecm9wQnRtUGFkJ1wiIGNsYXNzPVwiZHJhZ05Ecm9wXCI+XHJcbiAgICAgICAgPGRpdiBzdHlsZT1cInBvc2l0aW9uOnJlbGF0aXZlO1wiPlxyXG4gICAgICAgICAgICA8ZGl2IGlkPVwiZGl2MVwiIGNsYXNzPVwiZGl2MSBhZnUtZHJhZ25kcm9wLWJveFwiIChkcm9wKT1cImRyb3AoJGV2ZW50KVwiIChkcmFnb3Zlcik9XCJhbGxvd0Ryb3AoJGV2ZW50KVwiPlxyXG4gICAgICAgICAgICAgICAgPHAgY2xhc3M9XCJhZnUtZHJhZ25kcm9wLXRleHRcIj5EcmFnIE4gRHJvcDwvcD5cclxuICAgICAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgICAgIDwhLS0gPHNwYW4gY2xhc3M9J2xhYmVsIGxhYmVsLWluZm8nIGlkPVwidXBsb2FkLWZpbGUtaW5mb3t7aWR9fVwiPnt7c2VsZWN0ZWRGaWxlc1swXT8ubmFtZX19PC9zcGFuPiAtLT5cclxuICAgICAgICA8L2Rpdj5cclxuICAgIDwvZGl2PlxyXG4gICAgPCEtLSBEcmFnIG4gRHJvcCB0aGVtZSBFbmRzIC0tPlxyXG5cclxuICAgIDxsYWJlbCBmb3I9XCJzZWx7e2lkfX1cIiBjbGFzcz1cImJ0biBidG4tcHJpbWFyeSBidG4tc20gYWZ1LXNlbGVjdC1idG5cIiAqbmdJZj1cIiFoaWRlU2VsZWN0QnRuXCI+U2VsZWN0IEZpbGU8c3BhbiAqbmdJZj1cIm11bHRpcGxlXCI+czwvc3Bhbj48L2xhYmVsPlxyXG4gICAgPGlucHV0IHR5cGU9XCJmaWxlXCIgaWQ9XCJzZWx7e2lkfX1cIiBzdHlsZT1cImRpc3BsYXk6IG5vbmVcIiAqbmdJZj1cIiFoaWRlU2VsZWN0QnRuXCIgKGNoYW5nZSk9XCJvbkNoYW5nZSgkZXZlbnQpXCIgdGl0bGU9XCJTZWxlY3QgZmlsZVwiXHJcbiAgICAgICAgbmFtZT1cImZpbGVzW11cIiBbYWNjZXB0XT1mb3JtYXRzQWxsb3dlZCBbYXR0ci5tdWx0aXBsZV09XCJtdWx0aXBsZSA/ICcnIDogbnVsbFwiIC8+XHJcbiAgICA8YnV0dG9uIGNsYXNzPVwiYnRuIGJ0bi1pbmZvIGJ0bi1zbSByZXNldEJ0biBhZnUtcmVzZXQtYnRuXCIgKGNsaWNrKT1cInJlc2V0RmlsZVVwbG9hZCgpXCIgKm5nSWY9XCIhaGlkZVJlc2V0QnRuXCI+UmVzZXQ8L2J1dHRvbj5cclxuICAgIDxiciAqbmdJZj1cIiFoaWRlU2VsZWN0QnRuXCI+XHJcbiAgICA8cCBjbGFzcz1cImNvbnN0cmFpbnRzLWluZm8gYWZ1LWNvbnN0cmFpbnRzLWluZm9cIj4oe3tmb3JtYXRzQWxsb3dlZH19KSBTaXplIGxpbWl0LSB7eyhjb252ZXJ0U2l6ZShtYXhTaXplICoxMDI0MDAwKSl9fTwvcD5cclxuICAgIDwhLS1TZWxlY3RlZCBmaWxlIGxpc3QtLT5cclxuICAgIDxkaXYgY2xhc3M9XCJyb3dcIiAqbmdGb3I9XCJsZXQgc2Ygb2Ygc2VsZWN0ZWRGaWxlcztsZXQgaT1pbmRleFwiIGNsYXNzPVwiYWZ1LXZhbGlkLWZpbGVcIj5cclxuICAgICAgICA8cCBjbGFzcz1cImNvbC14cy0zIHRleHRPdmVyZmxvd1wiPjxzcGFuIGNsYXNzPVwidGV4dC1wcmltYXJ5XCI+e3tzZi5uYW1lfX08L3NwYW4+PC9wPlxyXG4gICAgICAgIDxwIGNsYXNzPVwiY29sLXhzLTMgcGFkTWFyZyBzaXplQ1wiPjxzdHJvbmc+KHt7Y29udmVydFNpemUoc2Yuc2l6ZSl9fSk8L3N0cm9uZz4mbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDsmbmJzcDs8L3A+XHJcbiAgICAgICAgPCEtLSAgPGlucHV0IGNsYXNzPVwiY29sLXhzLTMgcHJvZ3Jlc3MgY2FwdGlvblwiICB0eXBlPVwidGV4dFwiICBwbGFjZWhvbGRlcj1cIkNhcHRpb24uLlwiICBbKG5nTW9kZWwpXT1cIkNhcHRpb25baV1cIiAgKm5nSWY9XCJ1cGxvYWRDbGlja1wiLz4gLS0+XHJcbiAgICAgICAgPGRpdiBjbGFzcz1cInByb2dyZXNzIGNvbC14cy0zIHBhZE1hcmcgYWZ1LXByb2dyZXNzLWJhclwiICpuZ0lmPVwic2luZ2xlRmlsZSAmJiBwcm9ncmVzc0JhclNob3cgJiYgIWhpZGVQcm9ncmVzc0JhclwiPlxyXG4gICAgICAgICAgICA8c3BhbiBjbGFzcz1cInByb2dyZXNzLWJhciBwcm9ncmVzcy1iYXItc3VjY2Vzc1wiIHJvbGU9XCJwcm9ncmVzc2JhclwiIFtuZ1N0eWxlXT1cInsnd2lkdGgnOnBlcmNlbnRDb21wbGV0ZSsnJSd9XCI+e3twZXJjZW50Q29tcGxldGV9fSU8L3NwYW4+XHJcbiAgICAgICAgPC9kaXY+XHJcbiAgICAgICAgPGEgY2xhc3M9XCJjb2wteHMtMVwiIHJvbGU9XCJidXR0b25cIiAoY2xpY2spPVwicmVtb3ZlRmlsZShpLCdzZicpXCIgKm5nSWY9XCJ1cGxvYWRDbGlja1wiPjxpIGNsYXNzPVwiZmEgZmEtdGltZXNcIj48L2k+PC9hPlxyXG4gICAgPC9kaXY+XHJcbiAgICA8IS0tSW52YWxpZCBmaWxlIGxpc3QtLT5cclxuICAgIDxkaXYgY2xhc3M9XCJyb3cgdGV4dC1kYW5nZXJcIiAqbmdGb3I9XCJsZXQgbmEgb2Ygbm90QWxsb3dlZExpc3Q7bGV0IGo9aW5kZXhcIiBjbGFzcz1cImFmdS1pbnZhbGlkLWZpbGVcIj5cclxuICAgICAgICA8cCBjbGFzcz1cImNvbC14cy0zIHRleHRPdmVyZmxvd1wiPjxzcGFuPnt7bmFbJ2ZpbGVOYW1lJ119fTwvc3Bhbj48L3A+XHJcbiAgICAgICAgPHAgY2xhc3M9XCJjb2wteHMtMyBwYWRNYXJnIHNpemVDXCI+PHN0cm9uZz4oe3tuYVsnZmlsZVNpemUnXX19KTwvc3Ryb25nPjwvcD5cclxuICAgICAgICA8cCBjbGFzcz1cImNvbC14cy0zIFwiPnt7bmFbJ2Vycm9yTXNnJ119fTwvcD5cclxuICAgICAgICA8YSBjbGFzcz1cImNvbC14cy0xIGRlbEZpbGVJY29uXCIgcm9sZT1cImJ1dHRvblwiIChjbGljayk9XCJyZW1vdmVGaWxlKGosJ25hJylcIiAqbmdJZj1cInVwbG9hZENsaWNrXCI+Jm5ic3A7PGkgY2xhc3M9XCJmYSBmYS10aW1lc1wiPjwvaT48L2E+XHJcbiAgICA8L2Rpdj5cclxuXHJcbiAgICA8ZGl2IGNsYXNzPVwiYWZ1LXVwbG9hZC1zdGF0dXNcIj48cCAqbmdJZj1cInVwbG9hZE1zZ1wiIGNsYXNzPVwie3t1cGxvYWRNc2dDbGFzc319XCI+e3t1cGxvYWRNc2dUZXh0fX08cD48L2Rpdj5cclxuICAgIDxkaXYgKm5nSWY9XCIhc2luZ2xlRmlsZSAmJiBwcm9ncmVzc0JhclNob3cgJiYgIWhpZGVQcm9ncmVzc0JhclwiPlxyXG4gICAgICAgIDxkaXYgY2xhc3M9XCJwcm9ncmVzcyBjb2wteHMtNCBwYWRNYXJnIGFmdS1wcm9ncmVzcy1iYXJcIj5cclxuICAgICAgICAgICAgPHNwYW4gY2xhc3M9XCJwcm9ncmVzcy1iYXIgcHJvZ3Jlc3MtYmFyLXN1Y2Nlc3NcIiByb2xlPVwicHJvZ3Jlc3NiYXJcIiBbbmdTdHlsZV09XCJ7J3dpZHRoJzpwZXJjZW50Q29tcGxldGUrJyUnfVwiPnt7cGVyY2VudENvbXBsZXRlfX0lPC9zcGFuPlxyXG4gICAgICAgIDwvZGl2PlxyXG4gICAgICAgIDxicj5cclxuICAgICAgICA8YnI+XHJcbiAgICA8L2Rpdj5cclxuICAgIDxidXR0b24gY2xhc3M9XCJidG4gYnRuLXN1Y2Nlc3MgYWZ1LXVwbG9hZC1idG5cIiB0eXBlPVwiYnV0dG9uXCIgKGNsaWNrKT1cInVwbG9hZEZpbGVzKClcIiBbZGlzYWJsZWRdPSF1cGxvYWRCdG4+e3t1cGxvYWRCdG5UZXh0fX08L2J1dHRvbj5cclxuICAgIDxicj5cclxuPC9kaXY+XHJcblxyXG48IS0tLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vIEFUVEFDSCBQSU4gVEhFTUUgIC8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8tLT5cclxuPGRpdiAqbmdJZj1cInRoZW1lID09ICdhdHRhY2hQaW4nXCIgaWQ9XCJhdHRhY2hQaW5cIj5cclxuICAgIDxkaXYgc3R5bGU9XCJwb3NpdGlvbjpyZWxhdGl2ZTtwYWRkaW5nLWxlZnQ6NnB4XCI+XHJcbiAgICAgICAgPGEgY2xhc3M9J2J0biB1cF9idG4gYWZ1LWF0dGFjaC1waW4nIChjbGljayk9XCJhdHRhY2hwaW5PbmNsaWNrKClcIj5cclxuICAgICAgICAgICAge3thdHRhY2hQaW5UZXh0fX1cclxuICAgICAgICAgICAgPGkgY2xhc3M9XCJmYSBmYS1wYXBlcmNsaXBcIiBhcmlhLWhpZGRlbj1cInRydWVcIj48L2k+XHJcbiAgICAgICAgICAgIDwhLS0gPHAgc3R5bGU9XCJtYXJnaW4tdG9wOjEwcHhcIj4oe3tmb3JtYXRzQWxsb3dlZH19KSBTaXplIGxpbWl0LSB7eyhjb252ZXJ0U2l6ZShtYXhTaXplICogMTAyNDAwMCkpfX08L3A+IC0tPlxyXG4gICAgICAgICAgICA8aW5wdXQgdHlwZT1cImZpbGVcIiBpZD1cInNlbHt7aWR9fVwiIChjaGFuZ2UpPVwib25DaGFuZ2UoJGV2ZW50KVwiIHN0eWxlPVwiZGlzcGxheTogbm9uZVwiIHRpdGxlPVwiU2VsZWN0IGZpbGVcIiBuYW1lPVwiZmlsZXNbXVwiIFthY2NlcHRdPWZvcm1hdHNBbGxvd2VkXHJcbiAgICAgICAgICAgICAgICBbYXR0ci5tdWx0aXBsZV09XCJtdWx0aXBsZSA/ICcnIDogbnVsbFwiIC8+XHJcbiAgICAgICAgICAgIDxicj5cclxuICAgICAgICA8L2E+XHJcbiAgICAgICAgJm5ic3A7XHJcbiAgICAgICAgPHNwYW4gY2xhc3M9J2xhYmVsIGxhYmVsLWluZm8nIGlkPVwidXBsb2FkLWZpbGUtaW5mb3t7aWR9fVwiPnt7c2VsZWN0ZWRGaWxlc1swXT8ubmFtZX19PC9zcGFuPlxyXG4gICAgPC9kaXY+XHJcbjwvZGl2PlxyXG5cclxuPCEtLS8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLyBEUkFHIE4gRFJPUCBUSEVNRSAgLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy8vLy0tPlxyXG48IS0tIDxkaXYgKm5nSWY9XCJ0aGVtZSA9PSAnZHJhZ05Ecm9wJ1wiIGlkPVwiZHJhZ05Ecm9wXCI+XHJcbiAgPGRpdiBzdHlsZT1cInBvc2l0aW9uOnJlbGF0aXZlO3BhZGRpbmctbGVmdDo2cHhcIj5cclxuICAgIDxkaXYgaWQ9XCJkaXYxXCIgKGRyb3ApPVwiZHJvcCgkZXZlbnQpXCIgKGRyYWdvdmVyKT1cImFsbG93RHJvcCgkZXZlbnQpXCI+XHJcbiAgICAgIDxwPkRyYWcgTiBEcm9wPC9wPlxyXG4gICAgPC9kaXY+XHJcbiAgICA8c3BhbiBjbGFzcz0nbGFiZWwgbGFiZWwtaW5mbycgaWQ9XCJ1cGxvYWQtZmlsZS1pbmZve3tpZH19XCI+e3tzZWxlY3RlZEZpbGVzWzBdPy5uYW1lfX08L3NwYW4+XHJcbiAgPC9kaXY+XHJcbjwvZGl2PiAtLT5gICxcbiAgc3R5bGVzOiBbYC5jb25zdHJhaW50cy1pbmZve21hcmdpbi10b3A6MTBweDtmb250LXN0eWxlOml0YWxpY30ucGFkTWFyZ3twYWRkaW5nOjA7bWFyZ2luLWJvdHRvbTowfS5jYXB0aW9ue21hcmdpbi1yaWdodDo1cHh9LnRleHRPdmVyZmxvd3t3aGl0ZS1zcGFjZTpub3dyYXA7cGFkZGluZy1yaWdodDowO292ZXJmbG93OmhpZGRlbjt0ZXh0LW92ZXJmbG93OmVsbGlwc2lzfS51cF9idG57Y29sb3I6IzAwMDtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlcjoycHggc29saWQgIzVjNWI1Yjtib3JkZXItcmFkaXVzOjIycHh9LmRlbEZpbGVJY29ue3RleHQtZGVjb3JhdGlvbjpub25lO2NvbG9yOiNjZTA5MDl9LmRyYWdORHJvcCAuZGl2MXtkaXNwbGF5OmJvcmRlci1ib3g7Ym9yZGVyOjJweCBkYXNoZWQgIzVjNWI1YjtoZWlnaHQ6NnJlbTt3aWR0aDoyMHJlbX0uZHJhZ05Ecm9wIC5kaXYxPnB7dGV4dC1hbGlnbjpjZW50ZXI7Zm9udC13ZWlnaHQ6NzAwO2NvbG9yOiM1YzViNWI7bWFyZ2luLXRvcDoxLjRlbX0uZHJhZ05Ecm9wQnRtUGFke3BhZGRpbmctYm90dG9tOjJyZW19LmFmdS11cGxvYWQtc3RhdHVze3BhZGRpbmc6MDttYXJnaW46MH1AbWVkaWEgc2NyZWVuIGFuZCAobWF4LXdpZHRoOjYyMHB4KXsuY2FwdGlvbntwYWRkaW5nOjB9fUBtZWRpYSBzY3JlZW4gYW5kIChtYXgtd2lkdGg6NTEwcHgpey5zaXplQ3t3aWR0aDoyNSV9fUBtZWRpYSBzY3JlZW4gYW5kIChtYXgtd2lkdGg6MjYwcHgpey5jYXB0aW9uLC5zaXplQ3tmb250LXNpemU6MTBweH19LnJlc2V0QnRue21hcmdpbi1sZWZ0OjNweH1gXVxufSlcbmV4cG9ydCBjbGFzcyBBbmd1bGFyRmlsZVVwbG9hZGVyQ29tcG9uZW50IGltcGxlbWVudHMgT25Jbml0LCBPbkNoYW5nZXMge1xuICBASW5wdXQoKVxuICBjb25maWc6IGFueSA9IHt9O1xuICBASW5wdXQoKVxuICByZXNldFVwbG9hZDogYm9vbGVhbiA9IHRoaXMuY29uZmlnW1wicmVzZXRVcGxvYWRcIl07XG4gIEBPdXRwdXQoKVxuICBBcGlSZXNwb25zZSA9IG5ldyBFdmVudEVtaXR0ZXIoKTtcblxuICB0aGVtZTogc3RyaW5nO1xuICBpZDogbnVtYmVyO1xuICBoaWRlUHJvZ3Jlc3NCYXI6IGJvb2xlYW47XG4gIG1heFNpemU6IG51bWJlcjtcbiAgdXBsb2FkQVBJOiBzdHJpbmc7XG4gIGZvcm1hdHNBbGxvd2VkOiBzdHJpbmc7XG4gIG11bHRpcGxlOiBib29sZWFuO1xuICBoZWFkZXJzOiBhbnk7XG4gIGhpZGVSZXNldEJ0bjogYm9vbGVhbjtcbiAgaGlkZVNlbGVjdEJ0bjogYm9vbGVhbjtcbiAgYXR0YWNoUGluVGV4dDogc3RyaW5nO1xuICB1cGxvYWRCdG5UZXh0OiBzdHJpbmc7XG5cbiAgaWREYXRlOiBudW1iZXIgPSArbmV3IERhdGUoKTtcbiAgcmVnOiBSZWdFeHAgPSAvKD86XFwuKFteLl0rKSk/JC87XG4gIHNlbGVjdGVkRmlsZXM6IEFycmF5PGFueT4gPSBbXTtcbiAgbm90QWxsb3dlZExpc3Q6IEFycmF5PE9iamVjdD4gPSBbXTtcbiAgQ2FwdGlvbjogQXJyYXk8c3RyaW5nPiA9IFtdO1xuICBzaW5nbGVGaWxlID0gdHJ1ZTtcbiAgcHJvZ3Jlc3NCYXJTaG93ID0gZmFsc2U7XG4gIHVwbG9hZEJ0biA9IGZhbHNlO1xuICB1cGxvYWRNc2cgPSBmYWxzZTtcbiAgYWZ0ZXJVcGxvYWQgPSBmYWxzZTtcbiAgdXBsb2FkQ2xpY2sgPSB0cnVlO1xuICB1cGxvYWRNc2dUZXh0OiBzdHJpbmc7XG4gIHVwbG9hZE1zZ0NsYXNzOiBzdHJpbmc7XG4gIHBlcmNlbnRDb21wbGV0ZTogbnVtYmVyO1xuXG4gIGNvbnN0cnVjdG9yKCkge1xuICAgIC8vY29uc29sZS5sb2coXCJpZDogXCIsdGhpcy5pZCk7XG4gICAgLy9jb25zb2xlLmxvZyhcImlkRGF0ZTogXCIsdGhpcy5pZERhdGUpO1xuICAgIC8vY29uc29sZS5sb2coTWF0aC5yYW5kb20oKSk7XG4gIH1cblxuICBuZ09uQ2hhbmdlcyhyc3Q6IFNpbXBsZUNoYW5nZXMpIHtcbiAgICBpZiAocnN0W1wiY29uZmlnXCJdKSB7XG4gICAgICB0aGlzLnRoZW1lID0gdGhpcy5jb25maWdbXCJ0aGVtZVwiXSB8fCBcIlwiO1xuICAgICAgdGhpcy5pZCA9XG4gICAgICAgIHRoaXMuY29uZmlnW1wiaWRcIl0gfHxcbiAgICAgICAgcGFyc2VJbnQoKHRoaXMuaWREYXRlIC8gMTAwMDApLnRvU3RyaW5nKCkuc3BsaXQoXCIuXCIpWzFdKSArXG4gICAgICAgICAgTWF0aC5mbG9vcihNYXRoLnJhbmRvbSgpICogMjApICogMTAwMDA7XG4gICAgICB0aGlzLmhpZGVQcm9ncmVzc0JhciA9IHRoaXMuY29uZmlnW1wiaGlkZVByb2dyZXNzQmFyXCJdIHx8IGZhbHNlO1xuICAgICAgdGhpcy5oaWRlUmVzZXRCdG4gPSB0aGlzLmNvbmZpZ1tcImhpZGVSZXNldEJ0blwiXSB8fCBmYWxzZTtcbiAgICAgIHRoaXMuaGlkZVNlbGVjdEJ0biA9IHRoaXMuY29uZmlnW1wiaGlkZVNlbGVjdEJ0blwiXSB8fCBmYWxzZTtcbiAgICAgIHRoaXMudXBsb2FkQnRuVGV4dCA9IHRoaXMuY29uZmlnW1widXBsb2FkQnRuVGV4dFwiXSB8fCBcIlVwbG9hZFwiO1xuICAgICAgdGhpcy5tYXhTaXplID0gdGhpcy5jb25maWdbXCJtYXhTaXplXCJdIHx8IDIwO1xuICAgICAgdGhpcy51cGxvYWRBUEkgPSB0aGlzLmNvbmZpZ1tcInVwbG9hZEFQSVwiXVtcInVybFwiXTtcbiAgICAgIHRoaXMuZm9ybWF0c0FsbG93ZWQgPVxuICAgICAgICB0aGlzLmNvbmZpZ1tcImZvcm1hdHNBbGxvd2VkXCJdIHx8IFwiLmpwZywucG5nLC5wZGYsLmRvY3gsLnR4dCwuZ2lmLC5qcGVnXCI7XG4gICAgICB0aGlzLm11bHRpcGxlID0gdGhpcy5jb25maWdbXCJtdWx0aXBsZVwiXSB8fCBmYWxzZTtcbiAgICAgIHRoaXMuaGVhZGVycyA9IHRoaXMuY29uZmlnW1widXBsb2FkQVBJXCJdW1wiaGVhZGVyc1wiXSB8fCB7fTtcbiAgICAgIHRoaXMuYXR0YWNoUGluVGV4dCA9XG4gICAgICAgIHRoaXMuY29uZmlnW1wiYXR0YWNoUGluVGV4dFwiXSB8fCBcIkF0dGFjaCBzdXBwb3J0aW5nIGRvY3VtZW50cy4uXCI7XG4gICAgICAvL2NvbnNvbGUubG9nKFwiY29uZmlnOiBcIiwgdGhpcy5jb25maWcpO1xuICAgICAgLy9jb25zb2xlLmxvZyh0aGlzLmNvbmZpZ1tcIm1heFNpemVcIl0pO1xuICAgICAgLy9jb25zb2xlLmxvZyh0aGlzLmhlYWRlcnMpO1xuICAgICAgLy9jb25zb2xlLmxvZyhcInJzdDogXCIsIHJzdCk7XG4gICAgfVxuXG4gICAgaWYgKHJzdFtcInJlc2V0VXBsb2FkXCJdKSB7XG4gICAgICBpZiAocnN0W1wicmVzZXRVcGxvYWRcIl0uY3VycmVudFZhbHVlID09PSB0cnVlKSB7XG4gICAgICAgIHRoaXMucmVzZXRGaWxlVXBsb2FkKCk7XG4gICAgICB9XG4gICAgfVxuICB9XG5cbiAgbmdPbkluaXQoKSB7XG4gICAgLy9jb25zb2xlLmxvZyhcIklkOiBcIiwgdGhpcy5pZCk7XG4gICAgdGhpcy5yZXNldFVwbG9hZCA9IGZhbHNlO1xuICB9XG5cbiAgcmVzZXRGaWxlVXBsb2FkKCkge1xuICAgIHRoaXMuc2VsZWN0ZWRGaWxlcyA9IFtdO1xuICAgIHRoaXMuQ2FwdGlvbiA9IFtdO1xuICAgIHRoaXMubm90QWxsb3dlZExpc3QgPSBbXTtcbiAgICB0aGlzLnVwbG9hZE1zZyA9IGZhbHNlO1xuICAgIHRoaXMudXBsb2FkQnRuID0gZmFsc2U7XG4gIH1cblxuICBvbkNoYW5nZShldmVudDogYW55KSB7XG4gICAgLy9jb25zb2xlLmxvZyh0aGlzLm1heFNpemUgKyB0aGlzLmZvcm1hdHNBbGxvd2VkICsgdGhpcy5tdWx0aXBsZSk7XG4gICAgdGhpcy5ub3RBbGxvd2VkTGlzdCA9IFtdO1xuICAgIC8vY29uc29sZS5sb2coXCJvbmNoYW5nZSBoaXRcIik7XG4gICAgaWYgKHRoaXMuYWZ0ZXJVcGxvYWQgfHwgIXRoaXMubXVsdGlwbGUpIHtcbiAgICAgIHRoaXMuc2VsZWN0ZWRGaWxlcyA9IFtdO1xuICAgICAgdGhpcy5DYXB0aW9uID0gW107XG4gICAgICB0aGlzLmFmdGVyVXBsb2FkID0gZmFsc2U7XG4gICAgfVxuICAgIC8vRk9STUFUUyBBTExPV0VEIExJU1RcbiAgICAvL2NvbnNvbGUubG9nKFwiRk9STUFUUyBBTExPV0VEIExJU1Q9IFwiK3RoaXMuZm9ybWF0c0FsbG93ZWQpO1xuICAgIC8vTk8gT0YgRk9STUFUUyBBTExPV0VEXG4gICAgbGV0IGZvcm1hdHNDb3VudDogYW55O1xuICAgIGZvcm1hdHNDb3VudCA9IHRoaXMuZm9ybWF0c0FsbG93ZWQubWF0Y2gobmV3IFJlZ0V4cChcIlxcXFwuXCIsIFwiZ1wiKSk7XG4gICAgZm9ybWF0c0NvdW50ID0gZm9ybWF0c0NvdW50Lmxlbmd0aDtcbiAgICAvL2NvbnNvbGUubG9nKFwiTk8gT0YgRk9STUFUUyBBTExPV0VEPSBcIitmb3JtYXRzQ291bnQpO1xuICAgIC8vY29uc29sZS5sb2coXCItLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tXCIpO1xuXG4gICAgLy9JVEVSQVRFIFNFTEVDVEVEIEZJTEVTXG4gICAgbGV0IGZpbGU6IEZpbGVMaXN0O1xuICAgIGlmIChldmVudC50eXBlID09IFwiZHJvcFwiKSB7XG4gICAgICBmaWxlID0gZXZlbnQuZGF0YVRyYW5zZmVyLmZpbGVzO1xuICAgICAgLy9jb25zb2xlLmxvZyhcInR5cGU6IGRyb3BcIik7XG4gICAgfSBlbHNlIHtcbiAgICAgIGZpbGUgPSBldmVudC50YXJnZXQuZmlsZXMgfHwgZXZlbnQuc3JjRWxlbWVudC5maWxlcztcbiAgICAgIC8vY29uc29sZS5sb2coXCJ0eXBlOiBjaGFuZ2VcIik7XG4gICAgfVxuICAgIC8vY29uc29sZS5sb2coZmlsZSk7XG4gICAgbGV0IGN1cnJlbnRGaWxlRXh0OiBhbnk7XG4gICAgbGV0IGV4dDogYW55O1xuICAgIGxldCBmcm10QWxsb3dlZDogYm9vbGVhbjtcbiAgICBmb3IgKGxldCBpID0gMDsgaSA8IGZpbGUubGVuZ3RoOyBpKyspIHtcbiAgICAgIC8vQ0hFQ0sgRk9STUFUXG4gICAgICAvL0NVUlJFTlQgRklMRSBFWFRFTlNJT05cbiAgICAgIGN1cnJlbnRGaWxlRXh0ID0gdGhpcy5yZWcuZXhlYyhmaWxlW2ldLm5hbWUpO1xuICAgICAgY3VycmVudEZpbGVFeHQgPSBjdXJyZW50RmlsZUV4dFsxXTtcbiAgICAgIC8vY29uc29sZS5sb2coZmlsZVtpXS5uYW1lKTtcbiAgICAgIGZybXRBbGxvd2VkID0gZmFsc2U7XG4gICAgICAvL0ZPUk1BVCBBTExPV0VEIExJU1QgSVRFUkFURVxuICAgICAgZm9yIChsZXQgaiA9IGZvcm1hdHNDb3VudDsgaiA+IDA7IGotLSkge1xuICAgICAgICBleHQgPSB0aGlzLmZvcm1hdHNBbGxvd2VkLnNwbGl0KFwiLlwiKVtqXTtcbiAgICAgICAgLy9jb25zb2xlLmxvZyhcIkZPUk1BVCBMSVNUIChcIitqK1wiKT0gXCIrZXh0LnNwbGl0KFwiLFwiKVswXSk7XG4gICAgICAgIGlmIChqID09IGZvcm1hdHNDb3VudCkge1xuICAgICAgICAgIGV4dCA9IHRoaXMuZm9ybWF0c0FsbG93ZWQuc3BsaXQoXCIuXCIpW2pdICsgXCIsXCI7XG4gICAgICAgIH0gLy9jaGVjayBmb3JtYXRcbiAgICAgICAgaWYgKGN1cnJlbnRGaWxlRXh0LnRvTG93ZXJDYXNlKCkgPT0gZXh0LnNwbGl0KFwiLFwiKVswXSkge1xuICAgICAgICAgIGZybXRBbGxvd2VkID0gdHJ1ZTtcbiAgICAgICAgfVxuICAgICAgfVxuXG4gICAgICBpZiAoZnJtdEFsbG93ZWQpIHtcbiAgICAgICAgLy9jb25zb2xlLmxvZyhcIkZPUk1BVCBBTExPV0VEXCIpO1xuICAgICAgICAvL0NIRUNLIFNJWkVcbiAgICAgICAgaWYgKGZpbGVbaV0uc2l6ZSA+IHRoaXMubWF4U2l6ZSAqIDEwMjQwMDApIHtcbiAgICAgICAgICAvL2NvbnNvbGUubG9nKFwiU0laRSBOT1QgQUxMT1dFRCAoXCIrZmlsZVtpXS5zaXplK1wiKVwiKTtcbiAgICAgICAgICB0aGlzLm5vdEFsbG93ZWRMaXN0LnB1c2goe1xuICAgICAgICAgICAgZmlsZU5hbWU6IGZpbGVbaV0ubmFtZSxcbiAgICAgICAgICAgIGZpbGVTaXplOiB0aGlzLmNvbnZlcnRTaXplKGZpbGVbaV0uc2l6ZSksXG4gICAgICAgICAgICBlcnJvck1zZzogXCJJbnZhbGlkIHNpemVcIlxuICAgICAgICAgIH0pO1xuICAgICAgICAgIGNvbnRpbnVlO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgIC8vZm9ybWF0IGFsbG93ZWQgYW5kIHNpemUgYWxsb3dlZCB0aGVuIGFkZCBmaWxlIHRvIHNlbGVjdGVkRmlsZSBhcnJheVxuICAgICAgICAgIHRoaXMuc2VsZWN0ZWRGaWxlcy5wdXNoKGZpbGVbaV0pO1xuICAgICAgICB9XG4gICAgICB9IGVsc2Uge1xuICAgICAgICAvL2NvbnNvbGUubG9nKFwiRk9STUFUIE5PVCBBTExPV0VEXCIpO1xuICAgICAgICB0aGlzLm5vdEFsbG93ZWRMaXN0LnB1c2goe1xuICAgICAgICAgIGZpbGVOYW1lOiBmaWxlW2ldLm5hbWUsXG4gICAgICAgICAgZmlsZVNpemU6IHRoaXMuY29udmVydFNpemUoZmlsZVtpXS5zaXplKSxcbiAgICAgICAgICBlcnJvck1zZzogXCJJbnZhbGlkIGZvcm1hdFwiXG4gICAgICAgIH0pO1xuICAgICAgICBjb250aW51ZTtcbiAgICAgIH1cbiAgICB9XG5cbiAgICBpZiAodGhpcy5zZWxlY3RlZEZpbGVzLmxlbmd0aCAhPT0gMCkge1xuICAgICAgdGhpcy51cGxvYWRCdG4gPSB0cnVlO1xuICAgICAgaWYgKHRoaXMudGhlbWUgPT0gXCJhdHRhY2hQaW5cIikgdGhpcy51cGxvYWRGaWxlcygpO1xuICAgIH0gZWxzZSB7XG4gICAgICB0aGlzLnVwbG9hZEJ0biA9IGZhbHNlO1xuICAgIH1cbiAgICB0aGlzLnVwbG9hZE1zZyA9IGZhbHNlO1xuICAgIHRoaXMudXBsb2FkQ2xpY2sgPSB0cnVlO1xuICAgIHRoaXMucGVyY2VudENvbXBsZXRlID0gMDtcbiAgICBldmVudC50YXJnZXQudmFsdWUgPSBudWxsO1xuICB9XG5cbiAgdXBsb2FkRmlsZXMoKSB7XG4gICAgLy9jb25zb2xlLmxvZyh0aGlzLnNlbGVjdGVkRmlsZXMpO1xuXG4gICAgbGV0IGk6IGFueTtcbiAgICB0aGlzLnByb2dyZXNzQmFyU2hvdyA9IHRydWU7XG4gICAgdGhpcy51cGxvYWRDbGljayA9IGZhbHNlO1xuICAgIHRoaXMubm90QWxsb3dlZExpc3QgPSBbXTtcbiAgICBsZXQgaXNFcnJvciA9IGZhbHNlO1xuXG4gICAgbGV0IHhociA9IG5ldyBYTUxIdHRwUmVxdWVzdCgpO1xuICAgIGxldCBmb3JtRGF0YSA9IG5ldyBGb3JtRGF0YSgpO1xuXG4gICAgZm9yIChpID0gMDsgaSA8IHRoaXMuc2VsZWN0ZWRGaWxlcy5sZW5ndGg7IGkrKykge1xuICAgICAgaWYgKHRoaXMuQ2FwdGlvbltpXSA9PSB1bmRlZmluZWQpIHRoaXMuQ2FwdGlvbltpXSA9IFwiZmlsZVwiO1xuICAgICAgLy9BZGQgREFUQSBUTyBCRSBTRU5UXG4gICAgICBmb3JtRGF0YS5hcHBlbmQoXG4gICAgICAgIHRoaXMuQ2FwdGlvbltpXSxcbiAgICAgICAgdGhpcy5zZWxlY3RlZEZpbGVzW2ldIC8qLCB0aGlzLnNlbGVjdGVkRmlsZXNbaV0ubmFtZSovXG4gICAgICApO1xuICAgICAgLy9jb25zb2xlLmxvZyh0aGlzLnNlbGVjdGVkRmlsZXNbaV0rXCJ7XCIrdGhpcy5DYXB0aW9uW2ldK1wiIChDYXB0aW9uKX1cIik7XG4gICAgfVxuXG4gICAgaWYgKGkgPiAxKSB7XG4gICAgICB0aGlzLnNpbmdsZUZpbGUgPSBmYWxzZTtcbiAgICB9IGVsc2Uge1xuICAgICAgdGhpcy5zaW5nbGVGaWxlID0gdHJ1ZTtcbiAgICB9XG5cbiAgICB4aHIub25yZWFkeXN0YXRlY2hhbmdlID0gZXZudCA9PiB7XG4gICAgICAvL2NvbnNvbGUubG9nKFwib25yZWFkeVwiKTtcbiAgICAgIGlmICh4aHIucmVhZHlTdGF0ZSA9PT0gNCkge1xuICAgICAgICBpZiAoeGhyLnN0YXR1cyAhPT0gMjAwKSB7XG4gICAgICAgICAgaXNFcnJvciA9IHRydWU7XG4gICAgICAgICAgdGhpcy5wcm9ncmVzc0JhclNob3cgPSBmYWxzZTtcbiAgICAgICAgICB0aGlzLnVwbG9hZEJ0biA9IGZhbHNlO1xuICAgICAgICAgIHRoaXMudXBsb2FkTXNnID0gdHJ1ZTtcbiAgICAgICAgICB0aGlzLmFmdGVyVXBsb2FkID0gdHJ1ZTtcbiAgICAgICAgICB0aGlzLnVwbG9hZE1zZ1RleHQgPSBcIlVwbG9hZCBGYWlsZWQgIVwiO1xuICAgICAgICAgIHRoaXMudXBsb2FkTXNnQ2xhc3MgPSBcInRleHQtZGFuZ2VyIGxlYWRcIjtcbiAgICAgICAgICAvL2NvbnNvbGUubG9nKHRoaXMudXBsb2FkTXNnVGV4dCk7XG4gICAgICAgICAgLy9jb25zb2xlLmxvZyhldm50KTtcbiAgICAgICAgfVxuICAgICAgICB0aGlzLkFwaVJlc3BvbnNlLmVtaXQoeGhyKTtcbiAgICAgIH1cbiAgICB9O1xuXG4gICAgeGhyLnVwbG9hZC5vbnByb2dyZXNzID0gZXZudCA9PiB7XG4gICAgICB0aGlzLnVwbG9hZEJ0biA9IGZhbHNlOyAvLyBidXR0b24gc2hvdWxkIGJlIGRpc2FibGVkIGJ5IHByb2Nlc3MgdXBsb2FkaW5nXG4gICAgICBpZiAoZXZudC5sZW5ndGhDb21wdXRhYmxlKSB7XG4gICAgICAgIHRoaXMucGVyY2VudENvbXBsZXRlID0gTWF0aC5yb3VuZCgoZXZudC5sb2FkZWQgLyBldm50LnRvdGFsKSAqIDEwMCk7XG4gICAgICB9XG4gICAgICAvL2NvbnNvbGUubG9nKFwiUHJvZ3Jlc3MuLi5cIi8qK3RoaXMucGVyY2VudENvbXBsZXRlK1wiICVcIiovKTtcbiAgICB9O1xuXG4gICAgeGhyLm9ubG9hZCA9IGV2bnQgPT4ge1xuICAgICAgLy9jb25zb2xlLmxvZyhcIm9ubG9hZFwiKTtcbiAgICAgIC8vY29uc29sZS5sb2coZXZudCk7XG4gICAgICB0aGlzLnByb2dyZXNzQmFyU2hvdyA9IGZhbHNlO1xuICAgICAgdGhpcy51cGxvYWRCdG4gPSBmYWxzZTtcbiAgICAgIHRoaXMudXBsb2FkTXNnID0gdHJ1ZTtcbiAgICAgIHRoaXMuYWZ0ZXJVcGxvYWQgPSB0cnVlO1xuICAgICAgaWYgKCFpc0Vycm9yKSB7XG4gICAgICAgIHRoaXMudXBsb2FkTXNnVGV4dCA9IFwiU3VjY2Vzc2Z1bGx5IFVwbG9hZGVkICFcIjtcbiAgICAgICAgdGhpcy51cGxvYWRNc2dDbGFzcyA9IFwidGV4dC1zdWNjZXNzIGxlYWRcIjtcbiAgICAgICAgLy9jb25zb2xlLmxvZyh0aGlzLnVwbG9hZE1zZ1RleHQgKyBcIiBcIiArIHRoaXMuc2VsZWN0ZWRGaWxlcy5sZW5ndGggKyBcIiBmaWxlXCIpO1xuICAgICAgfVxuICAgIH07XG5cbiAgICB4aHIub25lcnJvciA9IGV2bnQgPT4ge1xuICAgICAgLy9jb25zb2xlLmxvZyhcIm9uZXJyb3JcIik7XG4gICAgICAvL2NvbnNvbGUubG9nKGV2bnQpO1xuICAgIH07XG5cbiAgICB4aHIub3BlbihcIlBPU1RcIiwgdGhpcy51cGxvYWRBUEksIHRydWUpO1xuICAgIGZvciAoY29uc3Qga2V5IG9mIE9iamVjdC5rZXlzKHRoaXMuaGVhZGVycykpIHtcbiAgICAgIC8vIE9iamVjdC5rZXlzIHdpbGwgZ2l2ZSBhbiBBcnJheSBvZiBrZXlzXG4gICAgICB4aHIuc2V0UmVxdWVzdEhlYWRlcihrZXksIHRoaXMuaGVhZGVyc1trZXldKTtcbiAgICB9XG4gICAgLy9sZXQgdG9rZW4gPSBzZXNzaW9uU3RvcmFnZS5nZXRJdGVtKFwidG9rZW5cIik7XG4gICAgLy94aHIuc2V0UmVxdWVzdEhlYWRlcihcIkNvbnRlbnQtVHlwZVwiLCBcInRleHQvcGxhaW47Y2hhcnNldD1VVEYtOFwiKTtcbiAgICAvL3hoci5zZXRSZXF1ZXN0SGVhZGVyKCdBdXRob3JpemF0aW9uJywgYEJlYXJlciAke3Rva2VufWApO1xuICAgIHhoci5zZW5kKGZvcm1EYXRhKTtcbiAgfVxuXG4gIHJlbW92ZUZpbGUoaTogYW55LCBzZl9uYTogYW55KSB7XG4gICAgLy9jb25zb2xlLmxvZyhcInJlbW92ZSBmaWxlIGNsaWNrZWQgXCIgKyBpKVxuICAgIGlmIChzZl9uYSA9PSBcInNmXCIpIHtcbiAgICAgIHRoaXMuc2VsZWN0ZWRGaWxlcy5zcGxpY2UoaSwgMSk7XG4gICAgICB0aGlzLkNhcHRpb24uc3BsaWNlKGksIDEpO1xuICAgIH0gZWxzZSB7XG4gICAgICB0aGlzLm5vdEFsbG93ZWRMaXN0LnNwbGljZShpLCAxKTtcbiAgICB9XG5cbiAgICBpZiAodGhpcy5zZWxlY3RlZEZpbGVzLmxlbmd0aCA9PSAwKSB7XG4gICAgICB0aGlzLnVwbG9hZEJ0biA9IGZhbHNlO1xuICAgIH1cbiAgfVxuXG4gIGNvbnZlcnRTaXplKGZpbGVTaXplOiBudW1iZXIpIHtcbiAgICAvL2NvbnNvbGUubG9nKGZpbGVTaXplICsgXCIgLSBcIisgc3RyKTtcbiAgICByZXR1cm4gZmlsZVNpemUgPCAxMDI0MDAwXG4gICAgICA/IChmaWxlU2l6ZSAvIDEwMjQpLnRvRml4ZWQoMikgKyBcIiBLQlwiXG4gICAgICA6IChmaWxlU2l6ZSAvIDEwMjQwMDApLnRvRml4ZWQoMikgKyBcIiBNQlwiO1xuICB9XG5cbiAgYXR0YWNocGluT25jbGljaygpIHtcbiAgICAvL2NvbnNvbGUubG9nKFwiSUQ6IFwiLCB0aGlzLmlkKTtcbiAgICBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInNlbFwiICsgdGhpcy5pZCkhLmNsaWNrKCk7XG4gICAgLy8kKFwiI1wiK1wic2VsXCIrdGhpcy5pZCkuY2xpY2soKTtcbiAgfVxuXG4gIGRyb3AoZXZlbnQ6IGFueSkge1xuICAgIGV2ZW50LnN0b3BQcm9wYWdhdGlvbigpO1xuICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KCk7XG4gICAgLy9jb25zb2xlLmxvZyhcImRyb3A6IFwiLCBldmVudCk7XG4gICAgLy9jb25zb2xlLmxvZyhcImRyb3A6IFwiLCBldmVudC5kYXRhVHJhbnNmZXIuZmlsZXMpO1xuICAgIHRoaXMub25DaGFuZ2UoZXZlbnQpO1xuICB9XG4gIGFsbG93RHJvcChldmVudDogYW55KSB7XG4gICAgZXZlbnQuc3RvcFByb3BhZ2F0aW9uKCk7XG4gICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICBldmVudC5kYXRhVHJhbnNmZXIuZHJvcEVmZmVjdCA9IFwiY29weVwiO1xuICAgIC8vY29uc29sZS5sb2coXCJhbGxvd0Ryb3A6IFwiLGV2ZW50KVxuICB9XG59XG5cbi8qIGludGVyZmFjZSBDT05GSUcge1xuICB1cGxvYWRBUEk6IHN0cmluZztcbiAgbXVsdGlwbGU/OiBib29sZWFuO1xuICBmb3JtYXRzQWxsb3dlZD86IHN0cmluZztcbiAgbWF4U2l6ZT86IG51bWJlcjtcbiAgaWQ/OiBudW1iZXI7XG4gIHJlc2V0VXBsb2FkPzogYm9vbGVhbjtcbiAgdGhlbWU/OiBzdHJpbmc7XG4gIGhpZGVQcm9ncmVzc0Jhcj86IGJvb2xlYW47XG4gfVxuICovIiwiaW1wb3J0IHsgTmdNb2R1bGUgfSBmcm9tICdAYW5ndWxhci9jb3JlJztcbmltcG9ydCB7IENvbW1vbk1vZHVsZSB9IGZyb20gJ0Bhbmd1bGFyL2NvbW1vbic7XG5pbXBvcnQgeyBBbmd1bGFyRmlsZVVwbG9hZGVyQ29tcG9uZW50IH0gZnJvbSAnLi9hbmd1bGFyLWZpbGUtdXBsb2FkZXIuY29tcG9uZW50JztcblxuQE5nTW9kdWxlKHtcbiAgaW1wb3J0czogW1xuICAgIENvbW1vbk1vZHVsZVxuICBdLFxuICBkZWNsYXJhdGlvbnM6IFtBbmd1bGFyRmlsZVVwbG9hZGVyQ29tcG9uZW50XSxcbiAgZXhwb3J0czogW0FuZ3VsYXJGaWxlVXBsb2FkZXJDb21wb25lbnRdXG59KVxuZXhwb3J0IGNsYXNzIEFuZ3VsYXJGaWxlVXBsb2FkZXJNb2R1bGUgeyB9XG4iXSwibmFtZXMiOlsidHNsaWJfMS5fX3ZhbHVlcyJdLCJtYXBwaW5ncyI6Ijs7Ozs7Ozs7QUFBQTtJQU9FO0tBQWlCOztnQkFMbEIsVUFBVSxTQUFDO29CQUNWLFVBQVUsRUFBRSxNQUFNO2lCQUNuQjs7Ozs7cUNBSkQ7Ozs7Ozs7O0lDbUhFOzs7O3NCQWxDYyxFQUFFOzJCQUVPLElBQUksQ0FBQyxNQUFNLENBQUMsYUFBYSxDQUFDOzJCQUVuQyxJQUFJLFlBQVksRUFBRTtzQkFlZixDQUFDLElBQUksSUFBSSxFQUFFO21CQUNkLGlCQUFpQjs2QkFDSCxFQUFFOzhCQUNFLEVBQUU7dUJBQ1QsRUFBRTswQkFDZCxJQUFJOytCQUNDLEtBQUs7eUJBQ1gsS0FBSzt5QkFDTCxLQUFLOzJCQUNILEtBQUs7MkJBQ0wsSUFBSTtLQVNqQjs7Ozs7SUFFRCxrREFBVzs7OztJQUFYLFVBQVksR0FBa0I7UUFDNUIsSUFBSSxHQUFHLENBQUMsUUFBUSxDQUFDLEVBQUU7WUFDakIsSUFBSSxDQUFDLEtBQUssR0FBRyxJQUFJLENBQUMsTUFBTSxDQUFDLE9BQU8sQ0FBQyxJQUFJLEVBQUUsQ0FBQztZQUN4QyxJQUFJLENBQUMsRUFBRTtnQkFDTCxJQUFJLENBQUMsTUFBTSxDQUFDLElBQUksQ0FBQztvQkFDakIsUUFBUSxDQUFDLENBQUMsSUFBSSxD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

/***/ }),

/***/ "./src/app/views/system/change-password.component.html":
/*!*************************************************************!*\
  !*** ./src/app/views/system/change-password.component.html ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"animated fadeIn\">\r\n\r\n    <div class=\"col-sm-12\">\r\n        <form #f=\"ngForm\" novalidate class=\"form-horizontal\">\r\n\r\n            <div class=\"card\">\r\n                <div class=\"card-header\">\r\n                    <strong>Change Password</strong>\r\n                </div>\r\n                <div class=\"card-body\">\r\n\r\n                    <div class=\"row\">\r\n                        <div class=\"col-sm-6\">\r\n                            <div class=\"form-group\">\r\n                                <label for=\"nf-password\">Password Baru*</label>\r\n                                <input type=\"password\" [(ngModel)]=\"form.password\" required #password=\"ngModel\" id=\"password\" name=\"password\" class=\"form-control\"\r\n                                    placeholder=\"\">\r\n                                <small *ngIf=\"f.submitted && !password.valid\" class=\"help-block text-danger\">{{ password.errors ? password.errors : 'password harus di isi' }}</small>\r\n                            </div>\r\n\r\n                            <div class=\"form-group\">\r\n                                <label for=\"nf-password_confirmation\">Konfirmasi Password Baru*</label>\r\n                                <input type=\"password\" class=\"form-password\" [(ngModel)]=\"form.password_confirmation\" required #password_confirmation=\"ngModel\" id=\"password_confirmation\" name=\"password_confirmation\" class=\"form-control\"\r\n                                    placeholder=\"\">\r\n                                <small *ngIf=\"f.submitted && !password_confirmation.valid\" class=\"help-block text-danger\">{{ password_confirmation.errors ? password_confirmation.errors : 'Nama harus di isi' }}</small>\r\n                            </div>\r\n\r\n                            <!--div class=\"form-group\">\r\n                                    <input type=\"checkbox\" class=\"form-checkbox\"> Show password\r\n                                </div-->\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div class=\"card-footer\">\r\n\r\n                    <button type=\"button\" (click)=\"changePassword()\" class=\"btn btn-sm btn-success\">\r\n                        <i class=\"fa fa-dot-circle-o\"></i> Submit</button>&nbsp;\r\n                </div>\r\n\r\n            </div>\r\n        </form>\r\n    </div>\r\n</div>"

/***/ }),

/***/ "./src/app/views/system/change-password.component.ts":
/*!***********************************************************!*\
  !*** ./src/app/views/system/change-password.component.ts ***!
  \***********************************************************/
/*! exports provided: PasswordComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "PasswordComponent", function() { return PasswordComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _services_index__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/index */ "./src/app/services/index.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var PasswordComponent = /** @class */ (function () {
    function PasswordComponent(usersService, alertService) {
        this.usersService = usersService;
        this.alertService = alertService;
        this.loading = false;
        this.showList = true;
        this.editMode = false;
        this.search = false;
        this.data = [];
        this.form = {};
        this.filter = {};
        this.pageSize = 10;
        this.currentPage = 1;
        this.totalItems = 0;
    }
    PasswordComponent.prototype.ngOnInit = function () {
        this.clearForm();
    };
    PasswordComponent.prototype.changePassword = function () {
        var _this = this;
        var confirmed = confirm('Apakah anda yakin mengganti password?');
        if (!confirmed) {
            return;
        }
        if (this.loading) {
            return;
        }
        this.loading = true;
        this.usersService.password(this.form, this.form.id)
            .subscribe(function (res) {
            _this.editMode = false;
            _this.alertService.success('Password telah diganti');
            _this.clearForm();
        }, function (err) {
            _this.loading = false;
            var errorArr;
            try {
                errorArr = JSON.parse(err.error);
            }
            catch (e) {
                errorArr = err.error;
            }
            errorArr = errorArr.error;
            var errMsg = '';
            Object.keys(errorArr).forEach(function (fieldName) {
                _this.htmlForm.form.controls[fieldName].setErrors(errorArr[fieldName][0]);
            });
            _this.alertService.error('Gagal untuk ganti password');
        });
    };
    PasswordComponent.prototype.clearForm = function () {
        window.scrollTo(0, 0);
        this.form = {
            'password': '',
            'password_confirmation': ''
        };
        this.editMode = false;
        this.showList = true;
    };
    __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"])('f'),
        __metadata("design:type", HTMLFormElement)
    ], PasswordComponent.prototype, "htmlForm", void 0);
    PasswordComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            moduleId: module.i,
            template: __webpack_require__(/*! ./change-password.component.html */ "./src/app/views/system/change-password.component.html")
        }),
        __metadata("design:paramtypes", [_services_index__WEBPACK_IMPORTED_MODULE_1__["UsersService"], _services_index__WEBPACK_IMPORTED_MODULE_1__["AlertService"]])
    ], PasswordComponent);
    return PasswordComponent;
}());



/***/ }),

/***/ "./src/app/views/system/roles.component.html":
/*!***************************************************!*\
  !*** ./src/app/views/system/roles.component.html ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"animated fadeIn\">\r\n\r\n            <div class=\"row\" *ngIf=\"showList\">\r\n                <div class=\"col-lg-12\">\r\n                    <div class=\"card\">\r\n                        <div class=\"card-header\">\r\n                            <i class=\"fa fa-align-justify\"></i> Roles\r\n\r\n                            <span class=\"float-right\">\r\n                                <button class=\"btn btn-primary btn-sm\" (click)=\"addData()\"><i class=\"fa fa-plus\"></i> Add New</button>&nbsp;\r\n                            </span>\r\n                        </div>\r\n                        <div class=\"card-body\">\r\n                            <div *ngIf=\"loading\" class=\"text-warning mb-0 mt-2\"><i class=\"fa fa-circle-o-notch fa-spin\"></i> Loading Data...</div>\r\n\r\n                            <table *ngIf=\"!loading\" class=\"table table-hover table-striped table-sm\">\r\n                                <thead>\r\n                                    <tr>\r\n                                        <th>Role Name</th>\r\n                                        <th>Description</th>\r\n                                        <th>Default</th>\r\n                                        <th>Protected</th>\r\n                                        <th>Login Destination</th>\r\n                                        <th>Action</th>\r\n                                    </tr>\r\n                                </thead>\r\n                                <tbody>\r\n                                    <tr *ngFor=\"let row of data\">\r\n                                        <td>{{ row.role_name }}</td>\r\n                                        <td>{{ row.role_description }}</td>\r\n                                        <td>\r\n                                            <span *ngIf=\"row.default\" class=\"badge badge-success\">Default</span>\r\n                                            <span *ngIf=\"!row.default\">-</span>\r\n                                        </td>\r\n                                        <td>\r\n                                            <span *ngIf=\"row.can_delete=='0'\" class=\"badge badge-success\">Protected</span>\r\n                                            <span *ngIf=\"row.can_delete=='1'\">-</span>\r\n                                        </td>\r\n                                        <td>{{ row.login_destination }}</td>\r\n                                        <td>\r\n                                            <button type=\"button\" class=\"btn btn-warning btn-sm\" (click)=\"editData(row)\"><i class=\"fa fa-pencil-alt\"></i></button>&nbsp;\r\n                                            <button type=\"button\" class=\"btn btn-danger btn-sm\" (click)=\"deleteData(row)\"><i class=\"fa fa-trash\"></i></button>&nbsp;\r\n                                        </td>\r\n                                    </tr>\r\n                                </tbody>\r\n                            </table>\r\n\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"row\" *ngIf=\"!showList\">\r\n\r\n                <div class=\"col-sm-12\">\r\n                    <form #f=\"ngForm\" novalidate (ngSubmit)=\"saveData(f.value, f.valid)\" class=\"form-horizontal\">\r\n\r\n                    <div class=\"card\">\r\n                        <div class=\"card-header\">\r\n                            <strong>Roles</strong> Add/Edit\r\n                        </div>\r\n                        <div class=\"card-body\">\r\n\r\n                            <div class=\"row\">\r\n                                <div class=\"col-sm-6\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"role_name\">Role Name</label>\r\n                                        <input type=\"text\" [(ngModel)]=\"form.role_name\" required #role_name=\"ngModel\" id=\"role_name\" name=\"role_name\" class=\"form-control\" placeholder=\"Enter Role Name..\">\r\n                                        <small class=\"help-block text-danger\" [hidden]=\"role_name.valid || (role_name.pristine && !f.submitted)\">\r\n                                                Please enter your role name\r\n                                        </small>\r\n                                    </div>\r\n\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"role_description\">Description</label>\r\n                                        <input type=\"text\" [(ngModel)]=\"form.role_description\" required #role_description=\"ngModel\" id=\"role_description\" name=\"role_description\" class=\"form-control\" placeholder=\"Enter Description..\">\r\n                                        <small class=\"help-block text-danger\" [hidden]=\"role_description.valid || (role_description.pristine && !f.submitted)\">\r\n                                                Please enter your role description\r\n                                        </small>\r\n                                    </div>\r\n                                </div>\r\n\r\n                                <div class=\"col-sm-6\">\r\n                                    <div class=\"form-group\">\r\n                                        <label for=\"username\">Login Destination</label>\r\n                                        <input type=\"text\" [(ngModel)]=\"form.login_destination\" required #login_destination=\"ngModel\" id=\"login_destination\" name=\"login_destination\" class=\"form-control\" placeholder=\"Enter Login Destination..\">\r\n                                        <small class=\"help-block text-danger\" [hidden]=\"login_destination.valid || (login_destination.pristine && !f.submitted)\">\r\n                                                Please enter default login destination\r\n                                        </small>\r\n                                    </div>\r\n\r\n                                    <div class=\"form-group\">\r\n                                        <label>Protected ?</label>\r\n                                        <div class=\"checkbox\">\r\n                                            <label>\r\n                                                <input type=\"checkbox\" (change)=\"updateProtected($event)\" [checked]=\"((form.can_delete==0) ? 'checked' : '')\" id=\"can_delete\" name=\"can_delete\" value=\"0\"> Yes\r\n                                            </label>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                </div>\r\n                            </div>\r\n\r\n                            <div class=\"row\" *ngFor=\"let system of permissionsList\">\r\n                                <div class=\"col-lg-12\">\r\n                                    <legend>{{ system.name }}</legend>\r\n\r\n                                    <div class=\"row\" *ngFor=\"let module of system.modules\">\r\n\r\n                                        <div class=\"col-lg-4\">{{ module.name }}</div>\r\n\r\n                                        <div class=\"col-lg-2\" *ngFor=\"let action of module.actions\">\r\n\r\n                                            <div class=\"checkbox\">\r\n                                                <label [for]=\"action.permissionId\">\r\n                                                    <input type=\"checkbox\" [value]=\"action.permissionId\" [checked]=\"(action.permissionId && (-1 !== form.permissions.indexOf(action.permissionId)) ? 'checked' : '')\" (change) =\"updateSelectedPermissions($event)\"> {{ action.name }}\r\n                                                </label>\r\n                                            </div>\r\n\r\n                                        </div>\r\n\r\n                                    </div>\r\n\r\n                                    <hr />\r\n                                </div>\r\n                            </div>\r\n\r\n                        </div>\r\n                        <div class=\"card-footer\">\r\n                            <button type=\"submit\" [disabled]=\"!f.valid\" class=\"btn btn-sm btn-success\">\r\n                                <i class=\"fa fa-dot-circle-o\"></i> Submit</button>&nbsp;\r\n                            <button type=\"reset\" class=\"btn btn-sm btn-danger\" (click)=\"clearForm()\">\r\n                                <i class=\"fa fa-ban\"></i> Cancel</button>&nbsp;\r\n                        </div>\r\n\r\n                    </div>\r\n                    </form>\r\n                </div>\r\n\r\n            </div>\r\n        </div>"

/***/ }),

/***/ "./src/app/views/system/roles.component.ts":
/*!*************************************************!*\
  !*** ./src/app/views/system/roles.component.ts ***!
  \*************************************************/
/*! exports provided: RolesComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "RolesComponent", function() { return RolesComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _services_index__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/index */ "./src/app/services/index.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var RolesComponent = /** @class */ (function () {
    function RolesComponent(alertService, rolesService, permissionsService) {
        this.alertService = alertService;
        this.rolesService = rolesService;
        this.permissionsService = permissionsService;
        this.loading = false;
        this.showList = true;
        this.editMode = false;
        this.permissionsList = [];
        this.data = [];
        this.roles = [];
        this.form = {};
        this.filter = {};
    }
    RolesComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.clearForm();
        this.permissionsService.get()
            .subscribe(function (res) {
            _this.permissionsList = res.data;
        }, function (err) {
            _this.alertService.error('Failed to load permissions list');
        });
        this.loadData();
    };
    RolesComponent.prototype.saveData = function (value, valid) {
        var _this = this;
        if (this.editMode) {
            this.rolesService.update(this.form, this.form.id)
                .subscribe(function (res) {
                _this.editMode = false;
                _this.alertService.success('Data Updated');
                _this.clearForm();
                _this.loadData();
            }, function (err) {
                _this.alertService.error('Failed to Update data');
            });
        }
        else {
            this.rolesService.save(this.form)
                .subscribe(function (res) {
                _this.alertService.success('Data Saved');
                _this.clearForm();
                _this.loadData();
            }, function (err) {
                _this.alertService.error('Failed to save data');
            });
        }
    };
    RolesComponent.prototype.addData = function () {
        this.showList = false;
        this.editMode = false;
    };
    RolesComponent.prototype.editData = function (entry) {
        this.showList = false;
        this.editMode = true;
        this.form = entry;
    };
    RolesComponent.prototype.deleteData = function (entry) {
        var _this = this;
        var confirmed = confirm('Are you sure to delete this data?');
        if (confirmed) {
            this.rolesService.delete(entry.id)
                .subscribe(function (res) {
                _this.loadData();
            }, function (err) {
                _this.alertService.error('Failed to delete ' + entry.username);
            });
        }
    };
    RolesComponent.prototype.clearForm = function () {
        window.scroll(0, 0);
        this.form = {
            'id': '',
            'role_name': '',
            'role_description': '',
            'can_delete': '1',
            'login_destination': '/',
            'permissions': []
        };
        this.editMode = false;
        this.showList = true;
    };
    RolesComponent.prototype.loadData = function () {
        var _this = this;
        this.loading = true;
        this.rolesService.get()
            .subscribe(function (res) {
            _this.loading = false;
            _this.data = res.data;
        }, function (err) {
            _this.loading = false;
            _this.alertService.error(err);
        });
    };
    RolesComponent.prototype.updateSelectedPermissions = function (event) {
        if (event.target.checked) {
            if (this.form.permissions.indexOf(parseInt(event.target.value, 10)) < 0) {
                this.form.permissions.push(parseInt(event.target.value, 10));
            }
        }
        else {
            if (this.form.permissions.indexOf(parseInt(event.target.value, 10)) > -1) {
                this.form.permissions.splice(this.form.permissions.indexOf(parseInt(event.target.value, 10)), 1);
            }
        }
    };
    RolesComponent.prototype.updateProtected = function (event) {
        if (event.target.checked) {
            this.form.can_delete = 0;
        }
        else {
            this.form.can_delete = 1;
        }
    };
    RolesComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            moduleId: module.i,
            template: __webpack_require__(/*! ./roles.component.html */ "./src/app/views/system/roles.component.html")
        }),
        __metadata("design:paramtypes", [_services_index__WEBPACK_IMPORTED_MODULE_1__["AlertService"],
            _services_index__WEBPACK_IMPORTED_MODULE_1__["RolesService"],
            _services_index__WEBPACK_IMPORTED_MODULE_1__["PermissionsService"]])
    ], RolesComponent);
    return RolesComponent;
}());



/***/ }),

/***/ "./src/app/views/system/settings.component.html":
/*!******************************************************!*\
  !*** ./src/app/views/system/settings.component.html ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"animated fadeIn\">\r\n\r\n    <div class=\"row\" *ngIf=\"showList\">\r\n\r\n        <div class=\"col-lg-12\">\r\n\r\n            <div class=\"card\">\r\n\r\n                <div class=\"card-header\">\r\n                    <i class=\"fa fa-align-justify\"></i> {{ moduleName }}\r\n\r\n                    <span class=\"float-right\">\r\n                        <button *appHasPermission=\"modulePermission + 'Create'\" class=\"btn btn-primary btn-sm\" (click)=\"addData()\">\r\n                            <i class=\"fa fa-plus\"></i> Add New</button>&nbsp;\r\n                    </span>\r\n                </div>\r\n\r\n                <!-- Search Form -->\r\n                <div class=\"card-body\">\r\n                    <form class=\"form-horizontal\">\r\n                        <div class=\"row\">\r\n                            <div class=\"col-sm-3\">\r\n                                <div class=\"form-group row\">\r\n                                    <label class=\"col-md-3 col-form-label\" for=\"nama\">Perusahaan</label>\r\n                                    <div class=\"col-md-9\">\r\n                                        <ng-select [items]=\"dd.perusahaan\"\r\n                                            bindLabel=\"name\"\r\n                                            bindValue=\"id\"\r\n                                            placeholder=\"- Select -\"\r\n                                            [(ngModel)]=\"filter.perusahaan_id\"\r\n                                            #perusahaan_id=\"ngModel\"\r\n                                            name=\"perusahaan_id\"\r\n                                            >\r\n                                        </ng-select>\r\n                                    </div>\r\n                                </div>\r\n                                <div class=\"form-group row\">\r\n                                    <label class=\"col-md-3 col-form-label\" for=\"nama\">Cabang</label>\r\n                                    <div class=\"col-md-9\">\r\n                                        <ng-select [items]=\"dd.cabang\"\r\n                                            bindLabel=\"name\"\r\n                                            bindValue=\"id\"\r\n                                            placeholder=\"- Select -\"\r\n                                            [(ngModel)]=\"filter.cabang_id\"\r\n                                            #cabang_id=\"ngModel\"\r\n                                            name=\"cabang_id\"\r\n                                            >\r\n                                        </ng-select>\r\n                                    </div>\r\n                                </div>\r\n                            </div>\r\n                            <div class=\"col-sm-3\">\r\n                                <div class=\"form-group row\">\r\n                                    <label class=\"col-md-3 col-form-label\" for=\"f-setting_description\">Setting</label>\r\n                                    <div class=\"col-md-9\">\r\n                                        <input type=\"text\" [(ngModel)]=\"filter.setting_description\" #setting_description=\"ngModel\" id=\"f-setting_description\"\r\n                                            name=\"setting_description\" class=\"form-control\" placeholder=\"\">\r\n                                    </div>\r\n                                </div>\r\n\r\n                            </div>\r\n                            <div class=\"col-md-4\">\r\n                                <button type=\"button\" class=\"btn btn-sm btn-primary\" (click)=\"doSearch()\">\r\n                                    <i class=\"fa fa-search\"></i> Filter</button>&nbsp;\r\n\r\n                                <button type=\"button\" class=\"btn btn-sm btn-primary\" (click)=\"clearSearch()\">\r\n                                    <i class=\"fa fa-ban\"></i> UnFilter</button>&nbsp;\r\n                            </div>\r\n                        </div>\r\n                    </form>\r\n                </div>\r\n                <!-- End Search Form -->\r\n\r\n                <!-- Table Data -->\r\n                <div class=\"card-body\">\r\n                    <div *ngIf=\"loading\" class=\"text-warning mb-0 mt-2\">\r\n                        <i class=\"fa fa-circle-o-notch fa-spin\"></i> Loading Data...</div>\r\n\r\n                    <table *ngIf=\"!loading\" class=\"table table-hover table-striped table-sm\">\r\n                        <thead>\r\n                            <tr>\r\n                                <th>No.</th>\r\n                                <th>Setting</th>\r\n                                <th>Value</th>\r\n                                <th> Perusahaan</th> \r\n                                <th>Cabang</th>\r\n                                <th>Action</th>\r\n                            </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                            <tr *ngFor=\"let row of data | paginate: { id: 'list',\r\n                                itemsPerPage: pageSize,\r\n                                currentPage: currentPage,\r\n                                totalItems: totalItems}; let i = index\">\r\n                                <td>{{ ((currentPage - 1) * pageSize) + i + 1 }}</td>\r\n                                <td>{{ row.setting_description }}</td>\r\n                                <td>{{ row.setting_value }}</td>\r\n                                <td>{{ row.perusahaan ? row.perusahaan.name : '' }}</td>\r\n                                <td>{{ row.cabang ? row.cabang.name : '' }}</td>\r\n                                <td>\r\n                                    <button *appHasPermission=\"modulePermission + 'Edit'\" type=\"button\" class=\"btn btn-warning btn-sm\" (click)=\"editData(row)\">\r\n                                        <i class=\"fa fa-pencil-alt\"></i>\r\n                                    </button>&nbsp;\r\n                                    <button *appHasPermission=\"modulePermission + 'Delete'\" type=\"button\" class=\"btn btn-danger btn-sm\" (click)=\"deleteData(row)\">\r\n                                        <i class=\"fa fa-trash\"></i>\r\n                                    </button>&nbsp;\r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>\r\n\r\n                    <div class=\"pull-right\">\r\n                        <pagination-controls id=\"list\" previousLabel=\"\" nextLabel=\"\" autoHide=\"true\" (pageChange)=\"loadData($event)\"></pagination-controls>\r\n                    </div>\r\n                </div>\r\n                <!-- End of Table Data -->\r\n\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n    <!-- Form -->\r\n    <div class=\"row\" *ngIf=\"!showList\">\r\n\r\n        <div class=\"col-sm-12\">\r\n            <form #f=\"ngForm\" novalidate (ngSubmit)=\"saveData(f.value, f.valid)\" class=\"form-horizontal\">\r\n\r\n                <div class=\"card\">\r\n\r\n                    <div class=\"card-header\">\r\n                        <strong>{{ moduleName }}</strong> Add/Edit\r\n                    </div>\r\n\r\n                    <div class=\"card-body\">\r\n\r\n                        <div class=\"row\">\r\n\r\n                            <div class=\"col-sm-6\">\r\n\r\n                                <div class=\"form-group\">\r\n                                    <label for=\"perusahaan_id\">Nama Perusahaan*</label>\r\n                                    <ng-select [items]=\"dd.perusahaan\"\r\n                                        bindLabel=\"name\"\r\n                                        bindValue=\"id\"\r\n                                        id=\"perusahaan_id\"\r\n                                        placeholder=\"- Select -\"\r\n                                        [(ngModel)]=\"form.perusahaan_id\"\r\n                                        #perusahaan_id=\"ngModel\"\r\n                                        name=\"perusahaan_id\"\r\n                                        required >\r\n                                    </ng-select>\r\n                                    <small *ngIf=\"f.submitted && !perusahaan_id.valid\" class=\"help-block text-danger\">{{ perusahaan_id.errors ? perusahaan_id.errors : 'perusahaan harus di isi' }}</small>\r\n                                </div>\r\n                                <div class=\"form-group\">\r\n                                    <label for=\"cabang_id\">Nama Cabang*</label>\r\n                                    <ng-select [items]=\"dd.cabang\"\r\n                                        bindLabel=\"name\"\r\n                                        bindValue=\"id\"\r\n                                        id=\"cabang_id\"\r\n                                        placeholder=\"- Select -\"\r\n                                        [(ngModel)]=\"form.cabang_id\"\r\n                                        #cabang_id=\"ngModel\"\r\n                                        name=\"cabang_id\"\r\n                                        required >\r\n                                    </ng-select>\r\n                                    <small *ngIf=\"f.submitted && !cabang_id.valid\" class=\"help-block text-danger\">{{ cabang_id.errors ? cabang_id.errors : 'cabang harus di isi' }}</small>\r\n                                </div>\r\n\r\n                                <div class=\"form-group\">\r\n                                    <label for=\"nf-setting_description\">Nama Setting*</label>\r\n                                    <input type=\"text\" [(ngModel)]=\"form.setting_description\" required #setting_description=\"ngModel\" id=\"setting_description\"\r\n                                        name=\"setting_description\" class=\"form-control\" placeholder=\"\">\r\n                                    <small *ngIf=\"f.submitted && !setting_description.valid\" class=\"help-block text-danger\">{{ setting_description.errors ? setting_description.errors : 'Nama Setting harus di isi' }}</small>\r\n                                </div>\r\n\r\n                                <div class=\"form-group\">\r\n                                    <label for=\"nf-setting_key\">Setting Key*</label>\r\n                                    <input type=\"text\" [(ngModel)]=\"form.setting_key\" required #setting_key=\"ngModel\" id=\"setting_key\"\r\n                                        name=\"setting_key\" class=\"form-control\" placeholder=\"\">\r\n                                    <small *ngIf=\"f.submitted && !setting_key.valid\" class=\"help-block text-danger\">{{ setting_key.errors ? setting_key.errors : 'Setting Key harus di isi' }}</small>\r\n                                </div>\r\n\r\n                                <div class=\"form-group\">\r\n                                    <label for=\"nf-setting_value\">Value*</label>\r\n                                    <input type=\"text\" [(ngModel)]=\"form.setting_value\" required #setting_value=\"ngModel\" id=\"setting_value\"\r\n                                        name=\"setting_value\" class=\"form-control\" placeholder=\"\">\r\n                                    <small *ngIf=\"f.submitted && !setting_value.valid\" class=\"help-block text-danger\">{{ setting_value.errors ? setting_value.errors : 'Setting Value harus di isi' }}</small>\r\n                                </div>\r\n\r\n                            </div>\r\n\r\n                        </div>\r\n                    </div>\r\n\r\n                    <div class=\"card-footer\">\r\n                        <div *ngIf=\"loading\" class=\"text-warning mb-0 mt-2\">\r\n                            <i class=\"fa fa-circle-o-notch fa-spin\"></i> Loading Data...</div>\r\n\r\n                        <button *ngIf=\"!loading\" type=\"submit\" [disabled]=\"!f.valid\" class=\"btn btn-sm btn-success\">\r\n                            <i class=\"fa fa-dot-circle-o\"></i> Submit</button>&nbsp;\r\n                        <button *ngIf=\"!loading\" type=\"reset\" class=\"btn btn-sm btn-danger\" (click)=\"clearForm()\">\r\n                            <i class=\"fa fa-ban\"></i> Cancel</button>&nbsp;\r\n                    </div>\r\n\r\n                </div>\r\n            </form>\r\n        </div>\r\n\r\n    </div>\r\n    <!-- End of Form -->\r\n\r\n</div>"

/***/ }),

/***/ "./src/app/views/system/settings.component.ts":
/*!****************************************************!*\
  !*** ./src/app/views/system/settings.component.ts ***!
  \****************************************************/
/*! exports provided: SettingComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "SettingComponent", function() { return SettingComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _base_component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./base.component */ "./src/app/views/system/base.component.ts");
/* harmony import */ var _services__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services */ "./src/app/services/index.ts");
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



var SettingComponent = /** @class */ (function (_super) {
    __extends(SettingComponent, _super);
    function SettingComponent(settingService, alertService) {
        var _this = _super.call(this, alertService) || this;
        _this.settingService = settingService;
        _this.dd = {
            'cabang': [],
            'perusahaan': []
        };
        _this.moduleName = 'QPI Settings';
        _this.moduleForm = {
            'id': '',
            'cabang_id': '',
            'perusahaan_id': '',
            'setting_key': '',
            'setting_value': '',
            'setting_description': ''
        };
        _this.moduleFilter = {
            'cabang_id': '',
            'perusahaan_id': '',
            'setting_key': ''
        };
        _this.modulePermission = 'System.Setting.';
        _this.model = settingService;
        return _this;
    }
    SettingComponent.prototype.loadDependencies = function () {
    };
    SettingComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            moduleId: module.i,
            template: __webpack_require__(/*! ./settings.component.html */ "./src/app/views/system/settings.component.html")
        }),
        __metadata("design:paramtypes", [_services__WEBPACK_IMPORTED_MODULE_2__["SettingService"],
            _services__WEBPACK_IMPORTED_MODULE_2__["AlertService"]])
    ], SettingComponent);
    return SettingComponent;
}(_base_component__WEBPACK_IMPORTED_MODULE_1__["BaseComponent"]));



/***/ }),

/***/ "./src/app/views/system/system-routing.module.ts":
/*!*******************************************************!*\
  !*** ./src/app/views/system/system-routing.module.ts ***!
  \*******************************************************/
/*! exports provided: SystemRoutingModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "SystemRoutingModule", function() { return SystemRoutingModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm5/router.js");
/* harmony import */ var _users_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./users.component */ "./src/app/views/system/users.component.ts");
/* harmony import */ var _roles_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./roles.component */ "./src/app/views/system/roles.component.ts");
/* harmony import */ var _change_password_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./change-password.component */ "./src/app/views/system/change-password.component.ts");
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
            title: 'Users & Roles'
        },
        children: [
            {
                path: 'users',
                component: _users_component__WEBPACK_IMPORTED_MODULE_2__["UsersComponent"],
                data: {
                    title: 'Users'
                }
            },
            {
                path: 'roles',
                component: _roles_component__WEBPACK_IMPORTED_MODULE_3__["RolesComponent"],
                data: {
                    title: 'Roles'
                }
            },
            {
                path: 'password',
                component: _change_password_component__WEBPACK_IMPORTED_MODULE_4__["PasswordComponent"],
                data: {
                    title: 'Change Password'
                }
            }
        ]
    }
];
var SystemRoutingModule = /** @class */ (function () {
    function SystemRoutingModule() {
    }
    SystemRoutingModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"].forChild(routes)],
            exports: [_angular_router__WEBPACK_IMPORTED_MODULE_1__["RouterModule"]]
        })
    ], SystemRoutingModule);
    return SystemRoutingModule;
}());



/***/ }),

/***/ "./src/app/views/system/system.module.ts":
/*!***********************************************!*\
  !*** ./src/app/views/system/system.module.ts ***!
  \***********************************************/
/*! exports provided: SystemModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "SystemModule", function() { return SystemModule; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var ngx_bootstrap_tabs__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ngx-bootstrap/tabs */ "./node_modules/ngx-bootstrap/tabs/fesm5/ngx-bootstrap-tabs.js");
/* harmony import */ var _shared_shared_module__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../shared/shared.module */ "./src/app/shared/shared.module.ts");
/* harmony import */ var ngx_bootstrap_modal__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ngx-bootstrap/modal */ "./node_modules/ngx-bootstrap/modal/fesm5/ngx-bootstrap-modal.js");
/* harmony import */ var _users_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./users.component */ "./src/app/views/system/users.component.ts");
/* harmony import */ var _roles_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./roles.component */ "./src/app/views/system/roles.component.ts");
/* harmony import */ var _change_password_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./change-password.component */ "./src/app/views/system/change-password.component.ts");
/* harmony import */ var _system_routing_module__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./system-routing.module */ "./src/app/views/system/system-routing.module.ts");
/* harmony import */ var _services_index__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ../../services/index */ "./src/app/services/index.ts");
/* harmony import */ var _settings_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./settings.component */ "./src/app/views/system/settings.component.ts");
/* harmony import */ var angular_file_uploader__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! angular-file-uploader */ "./node_modules/angular-file-uploader/fesm5/angular-file-uploader.js");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};











var SystemModule = /** @class */ (function () {
    function SystemModule() {
    }
    SystemModule = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["NgModule"])({
            imports: [
                _shared_shared_module__WEBPACK_IMPORTED_MODULE_2__["SharedModule"],
                ngx_bootstrap_tabs__WEBPACK_IMPORTED_MODULE_1__["TabsModule"].forRoot(),
                ngx_bootstrap_modal__WEBPACK_IMPORTED_MODULE_3__["ModalModule"].forRoot(),
                _system_routing_module__WEBPACK_IMPORTED_MODULE_7__["SystemRoutingModule"],
                angular_file_uploader__WEBPACK_IMPORTED_MODULE_10__["AngularFileUploaderModule"]
            ],
            declarations: [_users_component__WEBPACK_IMPORTED_MODULE_4__["UsersComponent"], _roles_component__WEBPACK_IMPORTED_MODULE_5__["RolesComponent"], _change_password_component__WEBPACK_IMPORTED_MODULE_6__["PasswordComponent"], _settings_component__WEBPACK_IMPORTED_MODULE_9__["SettingComponent"]],
            providers: [_services_index__WEBPACK_IMPORTED_MODULE_8__["UsersService"], _services_index__WEBPACK_IMPORTED_MODULE_8__["RolesService"], _services_index__WEBPACK_IMPORTED_MODULE_8__["PermissionsService"],
                _services_index__WEBPACK_IMPORTED_MODULE_8__["AlertService"]
            ]
        })
    ], SystemModule);
    return SystemModule;
}());



/***/ }),

/***/ "./src/app/views/system/users.component.html":
/*!***************************************************!*\
  !*** ./src/app/views/system/users.component.html ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"animated fadeIn\">\r\n\r\n    <div class=\"row\" *ngIf=\"showList\">\r\n        <div class=\"col-lg-12\">\r\n            <div class=\"card\">\r\n                <div class=\"card-header\">\r\n                    <i class=\"fa fa-align-justify\"></i> Users\r\n\r\n                    <span class=\"float-right\">\r\n                        <button class=\"btn btn-primary btn-sm\" (click)=\"addData()\"><i class=\"fa fa-plus\"></i> Add New</button>&nbsp;\r\n                    </span>\r\n                </div>\r\n\r\n                 <!--serch-->\r\n                 <div class=\"card-body\">\r\n                    <form class=\"form-horizontal\">\r\n                        <div class=\"row\">\r\n                            <div class=\"col-md-3\">\r\n\r\n                                <div class=\"form-group row\">\r\n                                    <label class=\"col-md-5 col-form-label\" for=\"username\">Username</label>\r\n                                    <div class=\"col-md-7\">\r\n                                        <input type=\"text\" [(ngModel)]=\"filter.username\" #username=\"ngModel\" id=\"username\" name=\"username\"\r\n                                            class=\"form-control\" placeholder=\"\">\r\n                                    </div>\r\n                                </div>\r\n\r\n                            </div>\r\n\r\n                            <div class=\"col-sm-3\">\r\n\r\n                                <div class=\"form-group row\">\r\n                                    <label class=\"col-md-4 col-form-label\" for=\"name\">Nama</label>\r\n                                    <div class=\"col-md-8\">\r\n                                        <input type=\"text\" [(ngModel)]=\"filter.name\" #name=\"ngModel\" id=\"name\" name=\"name\"\r\n                                            class=\"form-control\" placeholder=\"\">\r\n                                    </div>\r\n                                </div>\r\n\r\n                            </div>\r\n\r\n                            <div class=\"col-sm-3\">\r\n\r\n                                <div class=\"form-group row\">\r\n                                    <label class=\"col-md-4 col-form-label\" for=\"roles_id\">Roles</label>\r\n                                    <div class=\"col-md-8\">\r\n                                        <ng-select [items]=\"filterRoles\"\r\n                                            bindLabel=\"title\"\r\n                                            bindValue=\"id\"\r\n                                            placeholder=\"- Select -\"\r\n                                            [(ngModel)]=\"filter.roles_id\"\r\n                                            #roles_id=\"ngModel\"\r\n                                            id=\"roles_id\"\r\n                                            name=\"roles_id\">\r\n                                        </ng-select>\r\n                                    </div>\r\n                                </div>\r\n\r\n                            </div>\r\n\r\n                            <div class=\"col-md-3\">\r\n                                <button type=\"button\" class=\"btn btn-sm btn-primary\" (click)=\"doSearch()\">\r\n                                    <i class=\"fa fa-search\"></i> Filter</button>&nbsp;\r\n\r\n                                <button type=\"button\" class=\"btn btn-sm btn-primary\" (click)=\"clearSearch()\">\r\n                                    <i class=\"fa fa-ban\"></i> UnFilter</button>&nbsp;\r\n                            </div>\r\n                        </div>\r\n                    </form>\r\n                </div>\r\n\r\n                <div class=\"card-body\">\r\n                    <div *ngIf=\"loading\" class=\"text-warning mb-0 mt-2\"><i class=\"fa fa-circle-o-notch fa-spin\"></i> Loading Data...</div>\r\n\r\n                    <table *ngIf=\"!loading\" class=\"table table-hover table-striped table-sm\">\r\n                        <thead>\r\n                            <tr>\r\n                                <th>No.</th>\r\n                                <th>Username</th>\r\n                                <th>Name</th>\r\n                                <th>Email</th>\r\n                                <th>Role</th>\r\n                                <th>Action</th>\r\n                            </tr>\r\n                        </thead>\r\n                        <tbody>\r\n                            <tr *ngFor=\"let row of data| paginate: { id: 'users',\r\n                                    itemsPerPage: pageSize,\r\n                                    currentPage: currentPage,\r\n                                    totalItems: totalItems}; let i = index\">\r\n                                <td>{{ ((currentPage - 1) * pageSize) + i + 1 }}</td>\r\n                                <td>{{ row.username }}</td>\r\n                                <td>{{ row.name }}</td>\r\n                                <td>{{ row.email }}</td>\r\n                                <td>{{ row.roles? row.roles.title : '' }}</td>\r\n                              \r\n                                <td>\r\n                                    <button type=\"button\" class=\"btn btn-warning btn-sm\" (click)=\"editData(row)\"><i class=\"fa fa-pencil-alt\"></i></button>&nbsp;\r\n                                    <button type=\"button\" class=\"btn btn-danger btn-sm\" (click)=\"deleteData(row)\"><i class=\"fa fa-trash\"></i></button>&nbsp;\r\n                                </td>\r\n                            </tr>\r\n                        </tbody>\r\n                    </table>\r\n\r\n                    <div class=\"pull-right\">\r\n                        <pagination-controls id=\"users\" previousLabel=\"\" nextLabel=\"\" autoHide=\"true\" (pageChange)=\"currentPage = $event\"></pagination-controls>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n    <div class=\"row\" *ngIf=\"!showList\">\r\n\r\n        <div class=\"col-sm-12\">\r\n            <form #f=\"ngForm\" novalidate (ngSubmit)=\"saveData(f.value, f.valid)\" class=\"form-horizontal\">\r\n\r\n            <div class=\"card\">\r\n                <div class=\"card-header\">\r\n                    <strong>User</strong> Add/Edit\r\n                </div>\r\n                <div class=\"card-body\">\r\n\r\n                    <div class=\"row\">\r\n                        <div class=\"col-sm-6\">\r\n\r\n                           \r\n\r\n                            <div class=\"form-group\">\r\n                                <label for=\"nf-email\">Name</label>\r\n                                <input type=\"text\" [(ngModel)]=\"form.name\" required #name=\"ngModel\" id=\"name\" name=\"name\" class=\"form-control\" placeholder=\"Enter Name..\">\r\n                                <small class=\"help-block text-danger\" [hidden]=\"name.valid || (name.pristine && !f.submitted)\">\r\n                                        Please enter your name\r\n                                </small>\r\n                            </div>\r\n\r\n                            <div class=\"form-group\">\r\n                                <label for=\"nf-email\">Email</label>\r\n                                <input type=\"email\" [(ngModel)]=\"form.email\" required #email=\"ngModel\" id=\"email\" name=\"email\" class=\"form-control\" placeholder=\"Enter Email..\">\r\n                                <small class=\"help-block text-danger\" [hidden]=\"email.valid || (email.pristine && !f.submitted)\">\r\n                                        Please enter your email\r\n                                </small>\r\n                            </div>\r\n\r\n                              <div class=\"form-group\">\r\n                                <label for=\"roles\">Roles</label>\r\n                                <select [(ngModel)]=\"form.roles_id\" required #roles_id=\"ngModel\" id=\"roles_id\" name=\"roles_id\" class=\"form-control\">\r\n                                    <option *ngFor=\"let role of roles\" [ngValue]=\"role.id\">\r\n                                        {{ role.title }}\r\n                                    </option>\r\n                                </select>\r\n                                <small class=\"help-block text-danger\" [hidden]=\"roles_id.valid || (roles_id.pristine && !f.submitted)\">\r\n                                        Please enter user roles\r\n                                </small>\r\n                            </div>\r\n\r\n\t\t\t\t\t\t\t\r\n                        </div>\r\n\r\n                        <div class=\"col-sm-6\">\r\n                            <div class=\"form-group\">\r\n                                <label for=\"username\">Username</label>\r\n                                <input type=\"text\" [(ngModel)]=\"form.username\" required #username=\"ngModel\" id=\"username\" name=\"username\" class=\"form-control\" placeholder=\"Enter Username..\">\r\n                                <small class=\"help-block text-danger\" [hidden]=\"username.valid || (username.pristine && !f.submitted)\">\r\n                                        Please enter your username\r\n                                </small>\r\n                            </div>\r\n\r\n                            <div class=\"form-group\">\r\n                                <label for=\"password\">Password</label>\r\n                                <input type=\"password\" [(ngModel)]=\"form.password\" #password=\"ngModel\" id=\"password\" name=\"password\" class=\"form-control\" placeholder=\"Enter Password..\">\r\n                            </div>\r\n\r\n                          \r\n\r\n                           \r\n\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n                <div class=\"card-footer\">\r\n                    <button type=\"submit\" [disabled]=\"!f.valid\" class=\"btn btn-sm btn-success\">\r\n                        <i class=\"fa fa-dot-circle-o\"></i> Submit</button>&nbsp;\r\n                    <button type=\"reset\" class=\"btn btn-sm btn-danger\" (click)=\"clearForm()\">\r\n                        <i class=\"fa fa-ban\"></i> Cancel</button>&nbsp;\r\n                </div>\r\n\r\n            </div>\r\n            </form>\r\n        </div>\r\n\r\n    </div>\r\n</div>"

/***/ }),

/***/ "./src/app/views/system/users.component.ts":
/*!*************************************************!*\
  !*** ./src/app/views/system/users.component.ts ***!
  \*************************************************/
/*! exports provided: UsersComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "UsersComponent", function() { return UsersComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm5/core.js");
/* harmony import */ var _services_index__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/index */ "./src/app/services/index.ts");
var __decorate = (undefined && undefined.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (undefined && undefined.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var UsersComponent = /** @class */ (function () {
    function UsersComponent(usersService, rolesService, alertService) {
        this.usersService = usersService;
        this.rolesService = rolesService;
        this.alertService = alertService;
        this.loading = false;
        this.showList = true;
        this.editMode = false;
        this.search = false;
        this.data = [];
        this.dataLeasing = [];
        this.filterRoles = [];
        this.roles = [];
        this.form = {};
        this.filter = { 'username': '', 'name': '', 'roles_id': '' };
        this.dd = {
            dataPerusahaan: [],
            dataCabang: [],
            dataCabangall: [],
            dataDivisiPenjualan: []
        };
        this.pageSize = 10;
        this.currentPage = 1;
        this.totalItems = 0;
    }
    UsersComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.clearForm();
        this.rolesService.get()
            .subscribe(function (res) {
            _this.filterRoles = res.data;
        }, function (err) {
            _this.alertService.error(err);
        });
        this.rolesService.get()
            .subscribe(function (res) {
            _this.roles = res.data;
        }, function (err) {
            _this.alertService.error('Failed to load data');
        });
        this.loadData(1);
    };
    UsersComponent.prototype.saveData = function (value, valid) {
        var _this = this;
        if (this.editMode) {
            this.usersService.update(this.form, this.form.id)
                .subscribe(function (res) {
                _this.editMode = false;
                _this.alertService.success('Data Updated');
                _this.clearForm();
                _this.loadData(1);
            }, function (err) {
                _this.alertService.error('Failed to Update data');
            });
        }
        else {
            this.usersService.save(this.form)
                .subscribe(function (res) {
                _this.alertService.success('Data Saved');
                _this.clearForm();
                _this.loadData(1);
            }, function (err) {
                _this.alertService.error('Failed to save data');
            });
        }
    };
    UsersComponent.prototype.addData = function () {
        this.showList = false;
        this.editMode = false;
    };
    UsersComponent.prototype.editData = function (entry) {
        this.showList = false;
        this.editMode = true;
        this.form = entry;
    };
    UsersComponent.prototype.deleteData = function (entry) {
        var _this = this;
        var confirmed = confirm('Are you sure to delete this data?');
        if (confirmed) {
            this.usersService.delete(entry.id)
                .subscribe(function (res) {
                _this.loadData(1);
            }, function (err) {
                _this.alertService.error('Failed to delete ' + entry.username);
            });
        }
    };
    UsersComponent.prototype.clearForm = function () {
        window.scroll(0, 0);
        this.form = {
            'id': '',
            'name': '',
            'email': '',
            'username': '',
            'password': '',
            'roles_id': '',
            'cabang_id': '',
            'perusahaan_id': '',
            'divisi_penjualan_id': '',
            'status': '1'
        };
        this.editMode = false;
        this.showList = true;
    };
    UsersComponent.prototype.doSearch = function () {
        this.search = true;
        this.loadData(1);
    };
    UsersComponent.prototype.clearSearch = function () {
        this.search = false;
        this.data = [];
        this.totalItems = 0;
        this.filter = {
            'username': '',
            'name': '',
            'roles_id': ''
        };
        this.loadData(1);
    };
    UsersComponent.prototype.loadData = function (page) {
        var _this = this;
        this.loading = true;
        this.usersService.get(this.filter)
            .subscribe(function (res) {
            _this.loading = false;
            _this.data = res.data;
        }, function (err) {
            _this.loading = false;
            _this.alertService.error(err);
        });
    };
    /**
    * Filter Kota ketika memilih dropdown provinsi
    */
    UsersComponent.prototype.pilihCabang = function (onForm) {
        var _this = this;
        this.form.cabang_id = '';
        this.dd.dataCabang = this.dd.dataCabangall.filter(function (row) {
            if (onForm) {
                return row.perusahaan_id === _this.form.perusahaan_id;
            }
            else {
                return row.perusahaan_id === _this.filter.perusahaan_id;
            }
        });
    };
    UsersComponent = __decorate([
        Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"])({
            moduleId: module.i,
            template: __webpack_require__(/*! ./users.component.html */ "./src/app/views/system/users.component.html")
        }),
        __metadata("design:paramtypes", [_services_index__WEBPACK_IMPORTED_MODULE_1__["UsersService"],
            _services_index__WEBPACK_IMPORTED_MODULE_1__["RolesService"],
            _services_index__WEBPACK_IMPORTED_MODULE_1__["AlertService"]])
    ], UsersComponent);
    return UsersComponent;
}());



/***/ })

}]);
//# sourceMappingURL=views-system-system-module.js.map