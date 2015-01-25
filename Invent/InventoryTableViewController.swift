//
//  InventoryTableViewController.swift
//  Invent
//
//  Created by Michael Stromer on 11/23/14.
//  Copyright (c) 2014 Michael Stromer. All rights reserved.
//

import UIKit

class InventoryTableViewController: UITableViewController {
    let backgroundQueue : dispatch_queue_t = dispatch_queue_create("MVP.Invent.backgroundQueue", nil)
    var dataSource : Array<InventoryItem> = []
    
    var inventoryUrlEndpoint : String = ""
    override func viewDidLoad() {
        super.viewDidLoad()
        self.webActivityIndicator.color = UIColor.lightGrayColor()
        self.webActivityIndicator.startAnimating()
        self.webActivityIndicator.center = self.view.center
        self.view.addSubview(self.webActivityIndicator)
        
        
        self.tableView.registerNib(UINib(nibName: "InventoryItem", bundle: nil), forCellReuseIdentifier: "InventoryItem")
    }
    override func viewDidAppear(animated: Bool) {
        super.viewDidAppear(animated)
        
        self.requestInventory(self.inventoryUrlEndpoint, { (error, items) -> () in
            // present processed url session response results to the user –- update UI code //
        })
    }
    private var webActivityIndicator : UIActivityIndicatorView = UIActivityIndicatorView(activityIndicatorStyle: UIActivityIndicatorViewStyle.WhiteLarge)
    var urlSession = NSURLSession.sharedSession()
    // MARK: - Networking
    func requestInventory(endPointURL : String, responseHandler : (error : NSError? , items : Array<InventoryItem>?) -> () ) -> () {
        let url:NSURL = NSURL(string: endPointURL)!
        let task = self.urlSession.dataTaskWithURL(url, completionHandler: { (data, response, error) -> Void in
            
            var inventoryItems = self.inventoryItems(data)
            self.dataSource = self.inventoryItems(data)
            for index in 1...5 {
                self.dataSource += self.dataSource;
            }
            
            dispatch_async(dispatch_get_main_queue(), { () -> Void in
                self.tableView.reloadData()
                self.webActivityIndicator.hidden = true
            })
            
            responseHandler( error: nil, items: nil)
        })
        task.resume()
        responseHandler( error: nil, items: nil)
    }
    func inventoryItems(data: NSData) -> (Array<InventoryItem>) {
        var jsonParseError: NSError?
        var jsonResult = NSJSONSerialization.JSONObjectWithData(data, options: NSJSONReadingOptions.MutableContainers, error: &jsonParseError) as NSDictionary
        var rawInventoryItems = jsonResult["data"] as Array<Dictionary<String,String>>
        var refinedInventoryItems : Array<InventoryItem> = []
        for itemDict in rawInventoryItems {
            var item : InventoryItem = InventoryItem(bsn_id: itemDict["id"], bsn_name: itemDict["name"], bsn_image:     		  		                      itemDict["image"], bsn_description: itemDict["description"])
            refinedInventoryItems.append(item)
        }
        return refinedInventoryItems
    }
    override func numberOfSectionsInTableView(tableView: (UITableView!)) -> Int {
        // Return the number of sections.
        return 1
    }
    
    override func tableView(tableView: (UITableView!), numberOfRowsInSection section: Int) -> Int {
        // Return the number of rows in the section.
        return self.dataSource.count
    }
    
    override func tableView(tableView: UITableView, cellForRowAtIndexPath indexPath: NSIndexPath) -> UITableViewCell {
        let cell : UITableViewCell = tableView.dequeueReusableCellWithIdentifier("Cell", forIndexPath: indexPath) as UITableViewCell
        var supplyItem : InventoryItem = self.dataSource[indexPath.row]
        cell.textLabel?.text = supplyItem.bsn_name;
        
        // endpoint of corresponding supply item image //
        let urlString : String = supplyItem.bsn_image!
        
        dispatch_async(self.backgroundQueue, { () -> Void in
            
            /* capture the index of the cell that is requesting this image download operation */
            var capturedIndex : NSIndexPath? = indexPath.copy() as? NSIndexPath
            var err : NSError?
            /* get url for image and download raw data */
            let url = NSURL(string: urlString)!
            var imageData : NSData? = NSData(contentsOfURL: url, options: NSDataReadingOptions.DataReadingMappedIfSafe, error: &err)
            
            if err == nil {
                
                dispatch_sync(dispatch_get_main_queue(), { () -> Void in
                    
                    let itemImage = UIImage(data:imageData!)
                    let currentIndex = tableView.indexPathForCell(cell)
                    
                    // compare the captured cell index to some current cell index       //
                    // if the captured cell index is equal to some current cell index   //
                    // then the cell that requested the image is still on the screen so //
                    // we present the downloaded image else we do nothing               //
                    if currentIndex?.item == capturedIndex!.item {
                        cell.imageView?.image = itemImage
                        cell.setNeedsLayout()
                    }
                })
            }
        })
        return cell
    }
    // MARK: - Navigation
    
    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepareForSegue(segue: UIStoryboardSegue, sender: AnyObject!) {
        let destViewController = segue.destinationViewController as InventoryDetailViewController
        let selectedCell = sender as UITableViewCell
        let selectedIndex = self.tableView.indexPathForCell(selectedCell)
        destViewController.bsn_plumbingItem = self.dataSource[selectedIndex!.row]
        destViewController.bsn_capturedImage = selectedCell.imageView?.image    }



}
