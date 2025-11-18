<?php

namespace App\Services;

use App\Models\BuyerInquiry;
use App\Models\Suppliers;

class InquiryService
{
    public function sendInquiryToSuppliers($inquiryId)
    {
        $inquiry = BuyerInquiry::find($inquiryId);
        $suppliers = Suppliers::where('is_active', 'active')->get();

        $fakeMode = env('WHATSAPP_FAKE', true);

        foreach ($suppliers as $supplier) {
            $message = "Inquiry: {$inquiry->title}\nDescription: {$inquiry->description}\nFor Supplier: {$supplier->name}";

            if ($fakeMode) {
                \Log::info("FAKE WhatsApp message to {$supplier->phone}: " . $message);
            } else {
                $accessToken = env('WHATSAPP_ACCESS_TOKEN');
                $phoneId = env('WHATSAPP_PHONE_ID');

                $url = "https://graph.facebook.com/v20.0/{$phoneId}/messages";

                $data = [
                    "messaging_product" => "whatsapp",
                    "to" => $supplier->phone,
                    "type" => "template",
                    "template" => [
                        "name" => "buyer_inquiry",
                        "language" => ["code" => "en"],
                        "components" => [[
                            "type" => "body",
                            "parameters" => [
                                ["type" => "text", "text" => $inquiry->title],
                                ["type" => "text", "text" => $inquiry->description],
                            ]
                        ]]
                    ]
                ];

                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Authorization: Bearer $accessToken",
                    "Content-Type: application/json"
                ]);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($ch);
                curl_close($ch);

                \Log::info("REAL WhatsApp sent to {$supplier->phone}: " . $response);
            }
        }
    }
}
