//
//  InventoryItem.swift
//  Invent
//
//  Created by Michael Stromer on 11/23/14.
//  Copyright (c) 2014 Michael Stromer. All rights reserved.
//

import UIKit

class InventoryItem: NSObject {
    var bsn_id : String? = ""
    var bsn_name : String? = ""
    var bsn_image : String? = ""
    var bsn_description : String? = ""
    
    init(var bsn_id : String?, var bsn_name : String?, var bsn_image : String?, var bsn_description : String?) {
        self.bsn_id = bsn_id
        self.bsn_name = bsn_name
        self.bsn_image = bsn_image
        self.bsn_description = bsn_description
        super.init();
    }
}
