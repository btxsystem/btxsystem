@extends('layouts.admin')

@section('title')
    Add Role
    @parent
@stop

@section('content')
<section class="content-header">
        <h1>Add Roles</h1>
        <ol class="breadcrumb">
            <li>
                <a href="">Admin Management</a>
            </li>
            <li class="active">Add Roles</li>
        </ol>

        <div class="container">
                <table class="table table-striped">
                   <tbody>
                      <tr>
                         <td colspan="1">
                         <form action="{{ route('admin-management.roles.store') }}" class="well form-horizontal" method="POST" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                    <div class="form-group">
                                    <label class="col-md-2 control-label">Role Name</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                                            <input id="role" name="title" placeholder="Role Name" class="form-control" required="true" value="" type="text">
                                        </div>
                                    </div>
                                    </div>

                                    <label class="col-md-2 control-label">Permissions</label>
                                    <br>
                                    <div class="form-group">
                                        <div class="col-md-8 inputGroupContainer">
                                            <ul id="tree">
                                                <div class="col-md-4">
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="1" />Dashboard
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="2" />Category Ebook
                                                        </label>
                                                        <ul>
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="3" />List
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="4" />Detail
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="5" />Edit
                                                            </label>
                                                        </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox"/>Ebook
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="6" />Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="7" />Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="8" />View
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="9" />Delete
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" />Lesson
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="10"/>Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="11"/>Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="12"/>View
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="13"/>Delete
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" />Image
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="14"/>Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="15"/>Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="16"/>Delete
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox"/>Video
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="17" />Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="18" />Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="19" />View
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="20" />Delete
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="21"/>Members
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="24"/>Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="25"/>Topup
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="26"/>Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="27"/>Buy Product
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="28"/>View
                                                                </label>
                                                            </li>
                                                            
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="111"/>Export
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="112"/>Refound
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="113"/>Edit Password
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                    <li>
                                                        <li>
                                                            <label>
                                                                <input type="checkbox" name="permissions[]" value="22"/>Members Active
                                                            </label>

                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="23"/>Members Inactive
                                                                </label>
                                                            </li>
                                                        </li>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="31" />Customer
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="32"/>Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="33"/>Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="34"/>View
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="35"/>Delete
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </div>

                                                <div class="col-md-4">

                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="36" />NPWP
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="37"/>Verfication
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="38" />Tree
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="39" />Transfer Confirmation
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="40"/>View
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="41"/>Approve
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="42"/>Delete
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="43" />Claim Rewards
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="44"/>View
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="45"/>Confirm
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="46" />Withdrawal
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="47"/>Claim
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="48"/>Redirect
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="49"/>Non Redirect
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="50"/>Check Paid
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="51"/>Export Excel
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="52"/>Paid
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="53"/>Time
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="54"/>Time Edit
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>


                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="55" />Bitrex Money
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="56"/>Bitrex Point
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="57"/>Bitrex Point Topup
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="58"/>Bitrex Point View
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="59"/>Bitrex Value
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="60"/>Bitrex Value View
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="61" />Bonus
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="62"/>Sponsor
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="63"/>Pairing
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="64"/>Profit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="65"/>Reward
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="66"/>Event
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="67"/>Gift Event
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="71"/>CMS Our Product
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="72"/> Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="73"/> Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="74"/>Delete
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="75"/>View
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </div>

                                                <div class="col-md-4">
                                                    <!-- <label>
                                                        <input type="checkbox" name="permissions[]" value="70" />CMS
                                                    </label> -->
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="68" />Report
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="69"/>Transaction
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="76"/>CMS Headquarter
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="77"/> Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="78"/> Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="79"/>Delete
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="80"/>View
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="81"/>Publish
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="82"/>CMS Event
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="83"/> Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="84"/> Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="85"/>Publish
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="86"/>CMS Testimonial
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="87"/> Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="88"/> Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="89"/>Delete
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="90"/>Publish
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="91"/>CMS About US
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="92"/> Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="93"/> Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="94"/>Delete
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="95"/>Publish
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>

                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="96"/>Admin Management
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="97"/> Permission
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="98"/> Role
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="99"/>Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="100"/>Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="101"/>Delete
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="checkbox" name="permissions[]" value="102"/> User Company
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="103"/>Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="104"/>Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="105"/>Delete
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="text" value="106">List Va
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="text" value="107">Birthdate
                                                        </label>
                                                        <ul>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="108"/>Add
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="109"/>Edit
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label>
                                                                    <input type="checkbox" name="permissions[]" value="110"/>Delete
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"></label>
                                        <div class="col-md-8 inputGroupContainer">
                                            <button type="submit" class="btn btn-primary btn-block">Add</button>
                                        </div>
                                    </div>
                               </fieldset>
                            </form>
                         </td>
                      </tr>
                   </tbody>
                </table>
             </div>
    </section>
    <style>
        ul{
            list-style-type: none;
        }
    </style>
    <script src="{{asset('assets/js/treeView.js')}}"></script>

    <script type="text/javascript">
        $('#tree').checktree();
    </script>
@endsection
