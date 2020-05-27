import { NgModule } from "@angular/core";
import { AlertModule } from "ngx-bootstrap/alert";
import { BsDropdownModule } from "ngx-bootstrap/dropdown";
import { TabsModule } from "ngx-bootstrap/tabs";
import { PaginationModule } from "ngx-bootstrap/pagination";
import { ChartsModule } from "ng2-charts";
import { CommonModule } from "@angular/common";
import { NgbModule } from "@ng-bootstrap/ng-bootstrap";
import { FormsModule } from "@angular/forms";
import { GroupsComponent } from "./groups.component";
import { GroupsRoutingModule } from "./groups-routing/groups-routing.module";
import { GroupsDetailsComponent } from './groups-details/groups-details.component';
@NgModule({
  imports: [
    NgbModule,
    FormsModule,
    GroupsRoutingModule,
    CommonModule,
    ChartsModule,
    BsDropdownModule.forRoot(),
    TabsModule.forRoot(),
    PaginationModule.forRoot(),
    AlertModule.forRoot(),
  ],
  declarations: [GroupsComponent, GroupsDetailsComponent],
  providers: [],
})
export class GroupsModule {}
