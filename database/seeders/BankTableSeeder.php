<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;
use DB;
class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces=['Bangkok Bank (BBL) กรุงเทพ','Bank of Ayudhya (BAY) กรุงศรีอยุธยา','Kasikorn Bank (KBANK) กสิกรไทย','Krung Thai Bank (KTB) กรุงไทย','Siam Commercial Bank (SCB) ไทยพาณิชย์','Thai Military Bank (TMB) ทหารไทย','Bank for Agriculture (BAC) ธกส',
        'Government Savings Bank (GSB) ออมสิน','CIMB ซีไอเอ็มบี','
Citibank ซิตี้แบงค์','Government Housing Bank (GHB) อาคารสงเคราะห์','
HSBC เอชเอสบีซี','ICBC ไอซีบีซี','Islamic Bank (iBank) อิสลาม','Kiatnakin Bank เกียรตินาคิน','Land and House Bank (LHBANK) แลนแอนด์เฮาส์','
Mizuho Bank มิซูโฮ','Standard Chartered Bank สแตนดาร์ดชาร์เตอร์ด','Sumitomo Mitsui (SMBC) ซูมิโตโม มิตซุย','TMBThanachart Bank (ttb) ทีเอ็มบีธนชาต','Thai Credit Retail Bank (TCRBank) ไทยเครดิต','TISCO BANK (Tisco) ทิสโก้'
        ];
        foreach($provinces as $province){
                Bank::create([
                'name' => $province,
                'created_at' => now(),
                'updated_at' => now()        
            ]);
        }
    }
}
