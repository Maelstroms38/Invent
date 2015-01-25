//
//  CategoryTableViewController.swift
//  Invent
//
//  Created by Michael Stromer on 11/23/14.
//  Copyright (c) 2014 Michael Stromer. All rights reserved.
//

import UIKit

class CategoryTableViewController: UITableViewController {
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        self.tableView.registerNib(UINib(nibName: "CategoryTableView", bundle: nil), forCellReuseIdentifier: "InventoryItem")
    }

    
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject?) {
        
        var destViewController = segue.destinationViewController as InventoryTableViewController
        if segue.identifier == "tools" {
            destViewController.title = "Professors"
            destViewController.inventoryUrlEndpoint = "http://localhost:8888/api/v1/plumbing_tools.json"
        }
        else if segue.identifier == "pipes" {
            destViewController.title = "Students"
            destViewController.inventoryUrlEndpoint = "http://localhost:8888/api/v1/copper_pipes_and_fittings.json"
        }
        
    }
    private var webActivityIndicator : UIActivityIndicatorView = UIActivityIndicatorView(activityIndicatorStyle: UIActivityIndicatorViewStyle.WhiteLarge)
}
