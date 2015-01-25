//
//  ViewController.swift
//  Invent
//
//  Created by Michael Stromer on 11/23/14.
//  Copyright (c) 2014 Michael Stromer. All rights reserved.
//

import UIKit

class ViewController: UIViewController {
    
    var pageMenu : CAPSPageMenu?
    
    override func viewDidAppear(animated: Bool) {
        super.viewDidAppear(animated)
        // MARK: - UI Setup
        
        self.title = "Invent"
        self.navigationController?.navigationBar.barTintColor = UIColor(red: 20.0/255.0, green: 20.0/255.0, blue: 20.0/255.0, alpha: 1.0)
        self.navigationController?.navigationBar.shadowImage = UIImage()
        self.navigationController?.navigationBar.setBackgroundImage(UIImage(), forBarMetrics: UIBarMetrics.Default)
        self.navigationController?.navigationBar.barStyle = UIBarStyle.Black
        self.navigationController?.navigationBar.tintColor = UIColor.whiteColor()
        self.navigationController?.navigationBar.titleTextAttributes = [NSForegroundColorAttributeName: UIColor.orangeColor()]
        
        // MARK: - Scroll menu setup
        
        // Initialize view controllers to display and place in array
        var controllerArray : [UIViewController] = []
        
        var controller1 : CategoryTableViewController = CategoryTableViewController(nibName: "InventoryTableViewController", bundle: nil)
        controller1.title = "students"
        controllerArray.append(controller1)
        var controller : CategoryTableViewController = CategoryTableViewController(nibName: "CategoryTableViewController", bundle: nil)
        controller.title = "professors"
        controllerArray.append(controller)
        
        // Initialize scroll menu
        pageMenu = CAPSPageMenu(viewControllers: controllerArray)
        
        // Set frame for scroll menu (set y origin to height of navbar if navbar is used and is transparent)
        pageMenu!.view.frame = CGRectMake(0.0, 0.0, self.view.frame.width, self.view.frame.height)
        
        // Customize menu (Optional)
        pageMenu!.scrollMenuBackgroundColor = UIColor(red: 20.0/255.0, green: 20.0/255.0, blue: 20.0/255.0, alpha: 1.0)
        pageMenu!.viewBackgroundColor = UIColor(red: 20.0/255.0, green: 20.0/255.0, blue: 20.0/255.0, alpha: 1.0)
        pageMenu!.selectionIndicatorColor = UIColor.orangeColor()
        pageMenu!.addBottomMenuHairline = false
        pageMenu!.menuItemFont = UIFont(name: "HelveticaNeue", size: 35.0)!
        pageMenu!.menuHeight = 50.0
        pageMenu!.selectionIndicatorHeight = 0.0
        pageMenu!.menuItemWidthBasedOnTitleTextWidth = true
        pageMenu!.selectedMenuItemLabelColor = UIColor.orangeColor()
        
        self.view.addSubview(pageMenu!.view)
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
    }
}

