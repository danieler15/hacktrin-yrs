//
//  WFWifiHTTPClientDelegate.h
//  WiFood
//
//  Created by Daniel Ernst on 6/30/13.
//  Copyright (c) 2013 Daniel Ernst. All rights reserved.
//

#import <Foundation/Foundation.h>

@protocol WFWifiHTTPClientDelegate <NSObject>

- (void)clientDidLoadWifiLocationsList:(NSMutableArray *)wifi;

@end
