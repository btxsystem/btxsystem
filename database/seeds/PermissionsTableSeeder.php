<?php

use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PermissionsTableSeeder extends Seeder
{
    public function run()
    {

       // Permission::truncate();

        $permissions = [
            [ 'id' => '1'  , 'name' => 'Dashboard'],
            [ 'id' => '2'  , 'name' => 'Ebooks'],
            [ 'id' => '3'  , 'name' => 'Ebooks.list'],
            [ 'id' => '4'  , 'name' => 'Ebooks.list.detail'],
            [ 'id' => '5'  , 'name' => 'Ebooks.list.edit'],
            [ 'id' => '6'  , 'name' => 'Ebooks.list.book.add'],
            [ 'id' => '7'  , 'name' => 'Ebooks.list.book.edit'],
            [ 'id' => '8'  , 'name' => 'Ebooks.list.book.view'],
            [ 'id' => '9'  , 'name' => 'Ebooks.list.book.delete'],
            [ 'id' => '10'  , 'name' => 'Ebooks.list.book.lesson.add'],
            [ 'id' => '11'  , 'name' => 'Ebooks.list.book.lesson.edit'],
            [ 'id' => '12'  , 'name' => 'Ebooks.list.book.lesson.view'],
            [ 'id' => '13'  , 'name' => 'Ebooks.list.book.lesson.delete'],
            [ 'id' => '14'  , 'name' => 'Ebooks.list.book.image.add'],
            [ 'id' => '15'  , 'name' => 'Ebooks.list.book.image.edit'],
            [ 'id' => '16'  , 'name' => 'Ebooks.list.book.image.delete'],
            [ 'id' => '17'  , 'name' => 'Ebooks.list.video.add'],
            [ 'id' => '18'  , 'name' => 'Ebooks.list.video.edit'],
            [ 'id' => '19'  , 'name' => 'Ebooks.list.video.view'],
            [ 'id' => '20'  , 'name' => 'Ebooks.list.video.delete'],
            [ 'id' => '21'  , 'name' => 'Members'],
            [ 'id' => '22'  , 'name' => 'Members.active'],
            [ 'id' => '23'  , 'name' => 'Members.nonactive'],
            [ 'id' => '24'  , 'name' => 'Members.add'],
            [ 'id' => '25'  , 'name' => 'Members.Topup'],
            [ 'id' => '26'  , 'name' => 'Members.edit'],
            [ 'id' => '27'  , 'name' => 'Members.Buy_product'],
            [ 'id' => '28'  , 'name' => 'Members.view'],
            [ 'id' => '29'  , 'name' => 'Members.nonactive'],
            [ 'id' => '30'  , 'name' => 'Members.active'],
            [ 'id' => '31'  , 'name' => 'Customers'],
            [ 'id' => '32'  , 'name' => 'Customers.add'],
            [ 'id' => '33'  , 'name' => 'Customers.edit'],
            [ 'id' => '34'  , 'name' => 'Customers.view'],
            [ 'id' => '35'  , 'name' => 'Customers.delete'],
            [ 'id' => '36'  , 'name' => 'Verification_npwp'],
            [ 'id' => '37'  , 'name' => 'Verification_npwp.verification'],
            [ 'id' => '38'  , 'name' => 'Tree'],
            [ 'id' => '39'  , 'name' => 'Transfer_confirmation'],
            [ 'id' => '40'  , 'name' => 'Transfer_confirmation.detail'],
            [ 'id' => '41'  , 'name' => 'Transfer_confirmation.approve'],
            [ 'id' => '42'  , 'name' => 'Transfer_confirmation.delete'],
            [ 'id' => '43'  , 'name' => 'Claim_rewards'],
            [ 'id' => '44'  , 'name' => 'Claim_rewards.detail'],
            [ 'id' => '45'  , 'name' => 'Claim_rewards.confirm'],
            [ 'id' => '46'  , 'name' => 'Withdrawal'],
            [ 'id' => '47'  , 'name' => 'Withdrawal.claim'],
            [ 'id' => '48'  , 'name' => 'Withdrawal.claim.redirect'],
            [ 'id' => '49'  , 'name' => 'Withdrawal.claim.nonredirect'],
            [ 'id' => '50'  , 'name' => 'Withdrawal.claim.paid_checked'],
            [ 'id' => '51'  , 'name' => 'Withdrawal.claim.export_excel'],
            [ 'id' => '52'  , 'name' => 'Withdrawal.paid'],
            [ 'id' => '53'  , 'name' => 'Withdrawal.time'],
            [ 'id' => '54'  , 'name' => 'Withdrawal.time.edit'],
            [ 'id' => '55'  , 'name' => 'Bitrex-money'],
            [ 'id' => '56'  , 'name' => 'Bitrex-money.bitrex-points'],
            [ 'id' => '57'  , 'name' => 'Bitrex-money.bitrex-points.topup'],
            [ 'id' => '58'  , 'name' => 'Bitrex-money.bitrex-points.detail'],
            [ 'id' => '59'  , 'name' => 'Bitrex-money.bitrex-value'],
            [ 'id' => '60'  , 'name' => 'Bitrex-money.bitrex-value.detail'],
            [ 'id' => '61'  , 'name' => 'Bonus'],
            [ 'id' => '62'  , 'name' => 'Bonus.sponsor'],
            [ 'id' => '63'  , 'name' => 'Bonus.pairing'],
            [ 'id' => '64'  , 'name' => 'Bonus.profit'],
            [ 'id' => '65'  , 'name' => 'Bonus.reward'],
            [ 'id' => '66'  , 'name' => 'Bonus.event'],
            [ 'id' => '67'  , 'name' => 'Bonus.event.gift_event'],
            [ 'id' => '68'  , 'name' => 'Report'],
            [ 'id' => '69'  , 'name' => 'Report.transaction'],
            [ 'id' => '70'  , 'name' => 'Cms'],
            [ 'id' => '71'  , 'name' => 'Cms.our_product'],
            [ 'id' => '72'  , 'name' => 'Cms.our_product.add'],
            [ 'id' => '73'  , 'name' => 'Cms.our_product.edit'],
            [ 'id' => '74'  , 'name' => 'Cms.our_product.delete'],
            [ 'id' => '75'  , 'name' => 'Cms.our_product.detail'],   
            [ 'id' => '76'  , 'name' => 'Cms.headquarter'],
            [ 'id' => '77'  , 'name' => 'Cms.headquarter.add'],
            [ 'id' => '78'  , 'name' => 'Cms.headquarter.edit'],
            [ 'id' => '79'  , 'name' => 'Cms.headquarter.delete'],
            [ 'id' => '80'  , 'name' => 'Cms.headquarter.detail'],
            [ 'id' => '81'  , 'name' => 'Cms.headquarter.publish'],
            [ 'id' => '82'  , 'name' => 'Cms.event'],
            [ 'id' => '83'  , 'name' => 'Cms.event.add'],
            [ 'id' => '84'  , 'name' => 'Cms.event.edit'],
            [ 'id' => '85'  , 'name' => 'Cms.event.publish'],
            [ 'id' => '86'  , 'name' => 'Cms.testimonial'],
            [ 'id' => '87'  , 'name' => 'Cms.testimonial.add'],
            [ 'id' => '88'  , 'name' => 'Cms.testimonial.edit'],
            [ 'id' => '89'  , 'name' => 'Cms.testimonial.delete'],
            [ 'id' => '90'  , 'name' => 'Cms.testimonial.publish'],
            [ 'id' => '91'  , 'name' => 'Cms.about_us'],
            [ 'id' => '92'  , 'name' => 'Cms.about_us.add'],
            [ 'id' => '93'  , 'name' => 'Cms.about_us.edit'],
            [ 'id' => '94'  , 'name' => 'Cms.about_us.delete'],
            [ 'id' => '95'  , 'name' => 'Cms.about_us.publish'],
            [ 'id' => '96'  , 'name' => 'Admin_management'],
            [ 'id' => '97'  , 'name' => 'Admin_management.permssions'],
            [ 'id' => '98'  , 'name' => 'Admin_management.roles'],
            [ 'id' => '99'  , 'name' => 'Admin_management.roles.add'],
            [ 'id' => '100'  , 'name' => 'Admin_management.roles.edit'],
            [ 'id' => '101'  , 'name' => 'Admin_management.roles.delete'],
            [ 'id' => '102'  , 'name' => 'Admin_management.user_company'],
            [ 'id' => '103'  , 'name' => 'Admin_management.user_company.roles.add'],
            [ 'id' => '104'  , 'name' => 'Admin_management.user_company.roles.edit'],
            [ 'id' => '105'  , 'name' => 'Admin_management.user_company.roles.delete'],
        ];

        $cek = Permission::find(200);

        if(!$cek) {
        Permission::insert($permissions);
            
        }

    }
}
